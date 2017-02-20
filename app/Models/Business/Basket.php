<?php


namespace OlympicDrive\Models\Business;


use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use OlympicDrive\Http\Requests\CreateBasket;
use OlympicDrive\Http\Requests\UpdateBasket;
use OlympicDrive\Models\DataAccess\Read\Basket as BasketRead;
use OlympicDrive\Models\DataAccess\Read\Product as ProductRead;
use OlympicDrive\Models\DataAccess\Write\Basket as BasketWrite;
use stdClass;

class Basket extends BaseBusiness {
    
    protected $write;
    protected $read;
    
    public function __construct() {
        $this->write = new BasketWrite();
        $this->read = new BasketRead();
    }
    
    public function getStatusArray() {
        return $this->read->getStatusArray();
    }
    
    public function create(CreateBasket $request) {
        $productRead = new ProductRead;
        
        DB::beginTransaction();
        try {
            $basket = [
                'name'        => $request->input('name'),
                'description' => $request->input('description'),
                'price'       => $request->input('price'),
                'status'      => $request->input('status'),
                'created_by'  => Auth::user()->id,
                'created_at'  => new Carbon('now'),
            ];
            
            if (!$this->write->create($basket)) {
                throw new Exception('Une erreur est survenue, veuillez contacter le développeur', 409);
            }
    
            if($request->hasFile('picture')) {
                $basket = $this->read->getLastItems(1);
                $basket->picture = $this->uploadPicture($request->file('picture'), $basket, 'baskets');
                $this->write->save($basket);
            }
            
            foreach ($request->input('products') as $key => $productId) {
                $product = $productRead->getById($productId);
                if (is_null($product)) {
                    throw new Exception('Le produit demandé n\'existe pas.', 409);
                }
                
                $basket->products()->attach($product, [
                    'quantity'   => $request->input('quantity')[$key],
                    'created_at' => new Carbon('now')
                ]);
            }
            
            DB::commit();
            
            return $basket;
        } catch (Exception $e) {
            DB::rollBack();
            
            return $e;
        }
        
        if ($this->write->create($request)) {
            return $this->read->getLastItems(1);
        }
    }
    
    public function update(UpdateBasket $request, $id) {
        $productRead = new ProductRead;
        
        DB::beginTransaction();
        try {
            $basket = $this->read->getById($id);
            $basket->name = $request->input('name');
            $basket->description = $request->input('description');
            $basket->price = $request->input('price');
            $basket->status = $request->input('status');
            $basket->updated_at = new Carbon('now');
    
            if($request->hasFile('picture')) {
                $basket->picture = $this->uploadPicture($request->file('picture'), $basket, 'baskets');
            }
            
            if(!$this->write->save($basket)) {
                throw new Exception('Une erreur est survenue lors de l\'enregistrement du panier');
            }
            
            if (is_null($basket)) {
                throw new Exception('Une erreur est survenue, veuillez contacter le développeur', 409);
            }
            
            $basket->products()->detach();
            foreach ($request->input('products') as $key => $productId) {
                $product = $productRead->getById($productId);
                if (is_null($product)) {
                    throw new Exception('Le produit demandé n\'existe pas.', 409);
                }
                
                $basket->products()->attach($product, [
                    'quantity'   => $request->input('quantity')[$key],
                    'created_at' => new Carbon('now')
                ]);
            }
            
            DB::commit();
            
            return $basket;
            
        } catch (Exception $e) {
            DB::rollBack();
            
            return $e;
        }
    }
}