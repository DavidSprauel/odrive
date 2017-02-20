<?php

namespace OlympicDrive\Http\Controllers;

use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use OlympicDrive\Http\Requests\UpdateOrder;
use OlympicDrive\Models\Business\Order;

class OrderController extends Controller {
    
    private $business;
    private $paginate = 10;
    
    public function __construct() {
        parent::__construct();
        $this->business = new Order();
    }
    
    public function index(Request $request) {
        if($request->is('admin/*')) {
            $orders = $this->business->paginate($this->paginate);
    
            return view('back.orders.index')
                ->with('orders', $orders);
        } else {
            $orders = $this->business->paginateFromUser($this->paginate, Auth::user()->id);
    
            return view('front.orders.index')
                ->with('orders', $orders);
        }
    }
    
    public function show($id) {
        $order = $this->business->getById($id);
    
        return view('front.orders.show')
            ->with('order', $order);
    }
    
    public function create() {
        //
    }
    
    public function store(Request $request) {
        //
    }
    
    public function edit($id) {
        $order = $this->business->getById($id);
        $this->business->setViewed($order->id, Auth::user()->id);
    
        return view('back.orders.edit')
            ->with('order', $order);
    }
    
    public function update(UpdateOrder $request, $id) {
        $order = $this->business->update($request, $id);
        if($order instanceof Exception) {
            return response()->json([
                'errors' => $order->getMessage(),
            ], $order->getCode());
        }
        
        return response()->json($order, 200);
    }
    
    public function destroy($id) {
        //
    }
}
