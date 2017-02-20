<?php

namespace OlympicDrive\Http\Controllers;

use Auth;
use Exception;
use Illuminate\Http\Request;
use OlympicDrive\Http\Requests\ActiveUser;
use OlympicDrive\Http\Requests\CreateUser;
use OlympicDrive\Http\Requests\EditUser;
use OlympicDrive\Http\Requests\RegisterUser;
use OlympicDrive\Http\Requests\UpdateInfos;
use OlympicDrive\Models\Business\Informations;
use OlympicDrive\Models\Business\User as UserBusiness;

class UserController extends Controller {
    
    private $business;
    
    public function __construct() {
        $this->business = new UserBusiness();
        $this->infosBusiness = new Informations();
    }
    
    public function index() {
        $users = $this->business->paginate(10);
        
        return view('back.users.index')
            ->with('users', $users);
    }
    
    public function create() {
        $roles = $this->business->getRoles();
        return view('back.users.create')->with('roles', $roles);
    }
    
    public function store(CreateUser $request) {
        $user = $this->business->create($request);
        
        if(!is_null($user)) {
            return redirect()->route('users.index')
                ->with('flash', [
                    'code' => $this::SUCCESS,
                    'message' => $user->firstname.' a été ajouté avec success'
                ]);
        } else {
            return redirect()->back()
                ->with('flash', [
                    'code' => $this::ERROR,
                    'message' => 'Une erreur est survenue, veuillez contactez un développeur'
                ])
                ->withInput();
        }
    }
    
    public function edit($id) {
        $user = $this->business->getById($id);
        $roles = $this->business->getRoles();
        
        return view('back.users.edit')
            ->with('roles', $roles)
            ->with('user', $user);
    }
    
    public function update(EditUser $request, $id) {
        $user = $this->business->update($request, $id);
    
        if(!$user instanceof Exception) {
            return redirect()->route('users.index')
                ->with('flash', [
                    'code' => $this::SUCCESS,
                    'message' => $user->firstname.' a été modifié avec success'
                ]);
        } else {
            return redirect()->back()
                ->with('flash', [
                    'code' => $this::ERROR,
                    'message' => $user->getMessage()
                ])
                ->withInput();
        }
    }
    
    public function destroy(ActiveUser $request, $id) {
        $user = $this->business->switchActive($request, $id);
    
        if(!$user instanceof Exception) {
            return response()->json([
                'code' => $this::SUCCESS,
                'message' => 'Le status de '.$user->firstname.' a été changé en '.$user->getActiveText()
            ]);
        } else {
            return response()->json([
                'code' => $this::ERROR,
                'message' => $user->getMessage()
            ]);
        }
    }
    
    public function getInfos() {
        $countries = $this->infosBusiness->getCountryArray();
        
        return view('front.users.infos')->with('countries', $countries);
    }
    
    public function postInfos(UpdateInfos $request) {
        $user = $this->business->updateInfos($request);
    
        if(!$user instanceof Exception) {
            return redirect()->route('infos')
                ->with('flash', [
                    'code' => $this::SUCCESS,
                    'message' => 'Vos informations ont été mise à jour avec success'
                ]);
        } else {
            $message = $user->getMessage();
            if(Auth::user()->id == 5)  {
                $message = $user->getFile().' on line '.$user->getLine().'. <br /><strong>Message</strong>: '.$user->getMessage();
            }
            
            return redirect()->back()
                ->with('flash', [
                    'code' => $this::ERROR,
                    'message' => $message
                ])
                ->withInput();
        }
    }
}
