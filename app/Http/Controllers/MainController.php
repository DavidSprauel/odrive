<?php

namespace OlympicDrive\Http\Controllers;

use Auth;
use GuzzleHttp\Client;
use OlympicDrive\Http\Requests\Login;
use OlympicDrive\Http\Requests\RegisterUser;
use OlympicDrive\Http\Requests\ValidateOrder;
use OlympicDrive\Models\Business\Basket;
use OlympicDrive\Models\Business\Informations;
use OlympicDrive\Models\Business\Order;
use OlympicDrive\Models\Business\Product;
use OlympicDrive\Models\Business\User;

class MainController extends Controller {
    
    private $userBusiness;
    private $productBusiness;
    private $basketBusiness;
    private $orderBusiness;
    private $infosBusiness;
    
    public function __construct() {
        $this->productBusiness = new Product();
        $this->basketBusiness = new Basket();
        $this->userBusiness = new User();
        $this->infosBusiness = new Informations();
        $this->orderBusiness = new Order();
    }
    
    public function index() {
        $basket = $this->basketBusiness->getLastItems(1);
        $products = $this->productBusiness->getLastItems(4);
        
        return view('front.index')
            ->with('products', $products)
            ->with('basket', $basket);
    }
    
    public function getRegister() {
        $countries = $this->infosBusiness->getCountryArray();
        return view('front.users.register')->with('countries', $countries);
    }
    
    public function postRegister(RegisterUser $request) {
        $user = $this->userBusiness->register($request);
        if($user) {
            return redirect()->route('front.login')
                ->with('flash', [
                    'code' => $this::SUCCESS,
                    'message' => 'Votre compte a été ajouté avec success. Vous pouvez vous connecter dès mainenant.'
                ]);
        } else {
            return redirect()->back()
                ->with('flash', [
                    'code' => $this::ERROR,
                    'message' => 'Une erreur est survenue, veuillez contactez l\'assistance.'
                ])
                ->withInput();
        }
    }
    
    public function getLogin() {
        return view('front.users.login');
    }
    
    public function postLogin(Login $request) {
        $user = $this->userBusiness->login($request);
        
        if(!is_null($user) && Auth::check()) {
            return redirect()->intended('/checkout');
        }
    
        return redirect()->route('login')->with('flash', [
            'code' => $this::ERROR,
            'message' => 'Ce compte n\'existe pas ou vous n\'avez pas les droits pour vous connecter.'
        ]);
    }
    
    public function getCart() {
        $cart = session()->has('cart') ? session('cart') : [];
        
        return view('front.shop.cart')
            ->with('subTotal', 0)
            ->with('total', 0)
            ->with('cart', $cart);
    }
    
    public function getCheckout() {
        if(!session()->has('cart')) {
            return redirect('/');
        }
        $countries = $this->infosBusiness->getCountryArray();
        $cart = session('cart');
    
        return view('front.shop.checkout')
            ->with('total', 0)
            ->with('countries', $countries)
            ->with('cart', $cart);
    }
    
    public function postCheckout(ValidateOrder $request) {
        $order = $this->orderBusiness->create($request);
        
        return redirect()->route('thanks')->with('answer', $order);
    }
    
    public function validated() {
        return view('front.thanks');
    }
    
    public function deletSlackFile() {
        $url = 'https://slack.com/api/files.list?token=xoxp-2608015810-3053709798-130457915664-443afb6553a6a4f0ce91042fdf90121a&user=U031KLVPG';
        
        $client1 = new Client();
        $res = $client1->get($url);
        $files = json_decode($res->getBody());
        $ids = [];
        
        foreach($files->files as $f) {
            array_push($ids, $f->id);
        }
        
        if(!empty($ids)) {
            foreach ($ids as $id) {
                $deleteUrl = 'https://slack.com/api/files.delete?token=xoxp-2608015810-3053709798-130457915664-443afb6553a6a4f0ce91042fdf90121a&file=' . $id;
                $client1->get($deleteUrl);
            }
        } else {
            return 'No more files :)';
        }
        
        return 'You can refresh';
    }
    
    public function getContact() {
        return view('front.contact');
    }
    
    public function postContact() {
        
    }
}
