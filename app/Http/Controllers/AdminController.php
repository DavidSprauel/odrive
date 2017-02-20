<?php

namespace OlympicDrive\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OlympicDrive\Http\Requests\Login;
use OlympicDrive\Models\Business\Basket;
use OlympicDrive\Models\Business\Order;
use OlympicDrive\Models\Business\Product;
use OlympicDrive\Models\Business\User;

class AdminController extends Controller
{
    
    public function __construct() {
        parent::__construct();
        $this->userBusiness = new User();
        $this->orderBusiness = new Order();
        $this->productBusiness = new Product();
        $this->basketBusiness = new Basket();
    }
    
    public function logout() {
        $this->userBusiness->logout();
        return redirect('/');
    }
    
    public function dashboard() {
        $orders = $this->orderBusiness->getAllCount();
        $users = $this->userBusiness->getAllCount();
        $basket = $this->basketBusiness->getAllCount();
        $products = $this->productBusiness->getAllCount();
        
        $lastProduct = $this->productBusiness->getLastProducts();
        $lastBaskets = $this->basketBusiness->getLastItems();
        $lastOrders = $this->orderBusiness->getLastUnseenOrder();
        
        return view('back.dashboard')
            ->with('orderCount', $orders)
            ->with('usersCount', $users)
            ->with('productsCount', $products)
            ->with('basketsCount', $basket)
            ->with('lastBaskets', $lastBaskets)
            ->with('lastOrders', $lastOrders)
            ->with('lastProducts', $lastProduct);
    }
}
