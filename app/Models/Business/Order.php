<?php


namespace OlympicDrive\Models\Business;


use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Hash;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Notification;
use OlympicDrive\Http\Requests\UpdateOrder;
use OlympicDrive\Http\Requests\ValidateOrder;
use OlympicDrive\Models\Business\Basket;
use OlympicDrive\Models\DataAccess\Read\Order as OrderRead;
use OlympicDrive\Models\DataAccess\Write\Order as OrderWrite;
use OlympicDrive\Notifications\OrderNew;
use OlympicDrive\Notifications\OrderStatusUpdate;

class Order extends BaseBusiness {
    protected $write;
    protected $read;
    
    const STATUS_CANCEL = 0;
    const STATUS_NEW = 1;
    const STATUS_AWAITING_VALIDATION = 2;
    const STATUS_VALIDATED = 3;
    const STATUS_PAID = 4;
    const STATUS_SHIPPED = 5;
    const STATUS_AWAITING_INFORMATIONS = 6;
    const STATUS_CLOSED = 7;
    
    public function __construct() {
        $this->write = new OrderWrite();
        $this->read = new OrderRead();
    }
    
    public function create(ValidateOrder $request) {
        $userBusiness = new User();
        $infosBusiness = new Informations();
        $user = Auth::user() ?? null;
        $informations = Auth::user()->informations ?? $infosBusiness->getEmptyObject();
        $productBusiness = new Product();
        $basketBusiness = new Basket();
        
        
        DB::beginTransaction();
        try {
            $informations->company = $request->input('company');
            $informations->phone = $request->input('phone');
            $informations->address = $request->input('address');
            $informations->address_comp = $request->input('address_comp');
            $informations->country = $request->input('country');
            $informations->zipcode = $request->input('zipcode');
            $informations->city = $request->input('city');
    
            $informations->billing = $request->input('billing') ?? 0 ;
            $informations->billing_firstname = $request->input('billing_firstname');
            $informations->billing_lastname = $request->input('billing_lastname');
            $informations->billing_phone = $request->input('billing_phone');
            $informations->billing_address = $request->input('billing_address');
            $informations->billing_address_comp = $request->input('billing_address_comp');
            $informations->billing_country = $request->input('billing_country');
            $informations->billing_zipcode = $request->input('billing_zipcode');
            $informations->billing_city = $request->input('billing_city');
            
            if ($request->has('account') && is_null($user)) {
                $user = [
                    'role_id'    => User::ROLE_CLIENT,
                    'firstname'  => $request->input('firstname'),
                    'lastname'   => $request->input('lastname'),
                    'email'      => $request->input('email'),
                    'password'   => Hash::make($request->input('password')),
                    'created_at' => new Carbon('now')
                ];
                $user = $userBusiness->createFromScratch($user);
            }
    
            if (is_null($user)) {
                throw new Exception('Une erreur s\'est produite durant la creation de l\'utilisateur.', 403);
            }
            
            $informations->user_id = $user->id;
    
            $informations->save();
    
            $order = [
                'user_id'    => $user->id,
                'comment'    => $request->input('comment'),
                'status'     => self::STATUS_NEW,
                'created_at' => new Carbon('now')
            ];
            
            if(!$this->write->create($order)) {
                throw new Exception('Une erreur s\'est produite durant la creation de la commande', 403);
            }
            
            $order = $this->read->getLastItems(1);
            
            foreach($request->input('product') as $p) {
                $data = json_decode($p);
                if($data->type == 1) {
                    $product = $productBusiness->getById($data->id);
                    $order->products()->attach($product, [
                        'quantity'=> $data->quantity,
                        'created_at' => new Carbon('now')
                    ]);
                } else {
                    $product = $basketBusiness->getById($data->id);
                    $order->baskets()->attach($product, [
                        'quantity'=> $data->quantity,
                        'created_at' => new Carbon('now')
                    ]);
                }
            }
            
            session()->forget('cart');
            Notification::send($userBusiness->getAdmin(), new OrderNew($order));
            DB::commit();
            
            return true;
            
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
    
    public function getLastUnseenOrder() {
        return $this->read->getByStatus([self::STATUS_NEW, self::STATUS_AWAITING_VALIDATION]);
    }
    
    public function setViewed($order_id, $user_id) {
        return $this->write->setViewed($order_id, $user_id);
    }
    
    public function update(UpdateOrder $request, $id) {
        try {
            $order = $this->read->getById($id);
            
            if(is_null($order)) {
                throw new Exception('La commande #'.$id.' n\'existe pas.', 404);
            }
            
            if(!Auth::user()->isAdminOrEditor() && Auth::user()->id != $order->user_id) {
                throw new Exception('Vous n\'avez pas les droits pour modifier cette commande', 403);
            }
            
            $order->status = $request->input('status');
            $order->save();
            $order->user->notify(new OrderStatusUpdate($order));
            
            return $order;
            
        } catch (Exception $e) {
            return $e;
        }
        
        
    }
    
    public function paginateFromUser(int $nb, int $user_id) :LengthAwarePaginator {
        return $this->read->paginateFromUser($nb, $user_id);
    }
}