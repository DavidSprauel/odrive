<?php
namespace OlympicDrive\Models\Business;

use Carbon\Carbon;
use DB;
use Exception;
use Hash;
use Illuminate\Support\Facades\Auth;
use OlympicDrive\Http\Requests\ActiveUser;
use OlympicDrive\Http\Requests\CreateUser;
use OlympicDrive\Http\Requests\EditUser;
use OlympicDrive\Http\Requests\Login;
use OlympicDrive\Http\Requests\RegisterUser;
use OlympicDrive\Http\Requests\UpdateInfos;
use OlympicDrive\Models\Business\Informations as InformationsBusiness;
use OlympicDrive\Models\DataAccess\Read\User as UserRead;
use OlympicDrive\Models\DataAccess\Write\User as UserWrite;
use OlympicDrive\Models\Entities\Eloquent\Informations;
use OlympicDrive\Models\Entities\Eloquent\User as UserModel;

class User extends BaseBusiness {
    
    protected $write;
    protected $read;
    
    const ROLE_ADMIN = 1;
    const ROLE_EDITOR = 2;
    const ROLE_CLIENT = 3;
    const ROLE_GUEST = 0;
    
    public function __construct() {
        $this->write = new UserWrite();
        $this->read = new UserRead();
    }
    
    public function create(CreateUser $request) {
        $user = [
            'firstname' => $request->input('firstname'),
            'lastname'  => $request->input('lastname'),
            'role_id'   => $request->input('role'),
            'email'     => $request->input('email'),
            'password'  => Hash::make($request->input('password')),
        ];
        
        if ($this->write->create($user)) {
            return $this->read->getLastItems(1);
        }
        
        return null;
    }
    
    public function createFromScratch(array $user) {
        if ($this->write->create($user)) {
            return $this->read->getLastItems(1);
        }
    
        return null;
    }
    
    public function register(RegisterUser $request) {
        DB::beginTransaction();
        try {
            
            $user = [
                'firstname'  => $request->input('firstname'),
                'lastname'   => $request->input('lastname'),
                'role_id'    => UserModel::ROLE_CLIENT,
                'email'      => $request->input('email'),
                'password'   => Hash::make($request->input('password')),
                'created_at' => new Carbon('now')
            ];
    
            if (!$this->write->create($user)) {
                throw new Exception('Une erreur est survenue lors de la creation de l\'utilisateur', 403);
            }
            $user = $this->read->getLastItems(1);
            $informationsBusiness = new InformationsBusiness();
    
            $informations = [
                'user_id'      => $user->id,
                'company'      => $request->input('company'),
                'phone'        => $request->input('phone'),
                'address'      => $request->input('address'),
                'address_comp' => $request->input('address_comp'),
                'country'      => $request->input('country'),
                'zipcode'      => $request->input('zipcode'),
                'city'         => $request->input('city'),
                'created_at'   => new Carbon('now')
            ];
            
            if ($informationsBusiness->create($informations)) {
                DB::commit();
                
                return true;
            }
            
            DB::rollBack();
            throw new Exception('Une erreur est survenue lors de l\'enregistrement des informations', 403);
            
        } catch (Exception $e) {
            DB::rollBack();
            
            return $e;
        }
    }
    
    public function login(Login $request) {
        if (Auth::attempt([
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
            'active'   => 1
        ])
        ) {
            return Auth::user();
        }
        
        return null;
    }
    
    public function logout() {
        Auth::logout();
        
        return true;
    }
    
    public function getRoles() {
        return $this->read->getRoles();
    }
    
    public function update(EditUser $request, $id) {
        try {
            $user = $this->read->getById($id);
            if (is_null($user)) {
                throw new Exception('Utilisateur introuvable...', 404);
            }
            
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->role_id = $request->input('role');
            
            if ($request->input('email') != $user->email) {
                $emailExists = $this->read->exists('email', $request->input('email'));
                
                if (is_null($emailExists)) {
                    $user->email = $request->input('email');
                } else {
                    throw new Exception('Cette adresse email est déjà utilisée.', 409);
                }
            }
            
            if ($request->has('password') && $request->input('password') != '') {
                if ($request->input('password') == $request->input('password_conf')) {
                    $user->password = Hash::make($request->input('password'));
                } else {
                    throw new Exception('Vos mots de passe ne sont pas identiques.');
                }
            }
            
            $user = $this->write->save($user);
            
            return $user;
            
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function switchActive(ActiveUser $request, $id) {
        try {
            $user = $this->read->getById($id);
            if (is_null($user)) {
                throw new Exception('Utilisateur introuvable...', 404);
            }
            $user->active = $request->input('active');
            $this->write->save($user);
            
            return $user;
            
        } catch (Exception $e) {
            return $e;
        }
    }
    
    public function updateInfos(UpdateInfos $request) {
        DB::beginTransaction();
        try {
            $user = $this->read->getById(Auth::user()->id);
            
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            
            if ($request->has('password') && $request->input('password') != '') {
                $user->password = Hash::make($request->input('password'));
            }
            $this->write->save($user);
            
            $informationsBusiness = new InformationsBusiness();
            
            
            if (is_null($user->informations)) {
                $informations = new Informations();
                $informations->user_id = Auth::user()->id;
            } else {
                $informations = $informationsBusiness->getById($user->informations->id);
            }
            
            $informations->company = $request->input('company');
            $informations->phone = $request->input('phone');
            $informations->address = $request->input('address');
            $informations->address_comp = $request->input('address_comp');
            $informations->country = $request->input('country');
            $informations->zipcode = $request->input('zipcode');
            $informations->city = $request->input('city');
            
            $informations->billing = is_null($request->input('billing')) ? 0 : 1;
            $informations->billing_firstname = $request->input('billing_firstname');
            $informations->billing_lastname = $request->input('billing_lastname');
            $informations->billing_phone = $request->input('billing_phone');
            $informations->billing_address = $request->input('billing_address');
            $informations->billing_address_comp = $request->input('billing_address_comp');
            $informations->billing_country = $request->input('billing_country');
            $informations->billing_zipcode = $request->input('billing_zipcode');
            $informations->billing_city = $request->input('billing_city');
            
            $informationsBusiness->save($informations);
            
            DB::commit();
            
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            
            return $e;
        }
    }
}