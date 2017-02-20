<?php

namespace OlympicDrive\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use OlympicDrive\Http\Requests\AddToCart;
use OlympicDrive\Http\Requests\CreateProduct;
use OlympicDrive\Http\Requests\RemoveCart;
use OlympicDrive\Http\Requests\updateCart;
use OlympicDrive\Http\Requests\UpdateProduct;
use OlympicDrive\Models\Business\Basket;
use OlympicDrive\Models\Business\Product;

class ProductController extends Controller {
    
    private $business;
    private $limit;
    private $basketBusiness;
    
    public function __construct() {
        $this->limit = 12;
        $this->business = new Product();
        $this->basketBusiness = new Basket();
    }
    
    public function index(Request $request) {
        if($request->is('admin/*')) {
            $products = $this->business->paginate(10);
    
            return view('back.products.index')
                ->with('products', $products);
        } else {
            $products = $this->business->paginate($this->limit, [1]);
    
            return view('front.shop.index')
                ->with('products', $products);
        }
    }
    
    public function create() {
        $types = $this->business->getTypeArray();
        $status = $this->business->getStatusArray();
        
        return view('back.products.create')
            ->with('status', $status)
            ->with('types', $types);
    }
    
    public function store(CreateProduct $request) {
        $product = $this->business->create($request);
        
        if (!$product instanceof Exception) {
            return redirect()->route('products.index')
                ->with('flash', [
                    'code'    => $this::SUCCESS,
                    'message' => 'Le produit "' . $product->name . '" a été ajouté avec success'
                ]);
        } else {
            return redirect()->back()
                ->with('flash', [
                    'code'    => $this::ERROR,
                    'message' => 'Une erreur est survenue, veuillez contactez un développeur'
                ])
                ->withInput();
        }
    }
    
    public function show($id) {
        $product = $this->business->getById($id);
        $related = $this->business->getRelatedProducts($product);
        
        return view('front.shop.show')
            ->with('related', $related)
            ->with('product', $product);
    }
    
    public function edit($id) {
        $product = $this->business->getById($id);
        $types = $this->business->getTypeArray();
        $status = $this->business->getStatusArray();
        
        return view('back.products.edit')
            ->with('types', $types)
            ->with('status', $status)
            ->with('product', $product);
    }
    
    public function update(UpdateProduct $request, $id) {
        $product = $this->business->update($request, $id);
        
        if (!$product instanceof Exception) {
            return redirect()->route('products.index')
                ->with('flash', [
                    'code'    => $this::SUCCESS,
                    'message' => 'Le produit "' . $product->name . '" a été modifié avec success'
                ]);
        } else {
            return redirect()->back()
                ->with('flash', [
                    'code'    => $this::ERROR,
                    'message' => 'Une erreur est survenue, veuillez contactez un développeur'
                ])
                ->withInput();
        }
    }
    
    public function destroy($id) {
        $product = $this->business->delete($id);
        if ($product) {
            return redirect()->route('products.index')
                ->with('flash', [
                    'code'    => $this::SUCCESS,
                    'message' => 'Le produit a bien été supprimé.'
                ]);
        }
        
        return redirect()->route('products.index')
            ->with('flash', [
                'code'    => $this::ERROR,
                'message' => 'Une erreur est survenue lors de la suppression.'
            ]);
    }
    
    public function search(Request $request) {
        $products = $this->business->search($request, $this->limit);
    
        return view('front.shop.index')
            ->with('products', $products);
    }
    
    public function removeFromCart(RemoveCart $request) {
        $cart = session('cart');
        $id = $request->input('product');
        $type = $request->input('type');
        
        if(isset($cart[$id]) && $cart[$id]['type'] == $type) {
            unset($cart[$id]);
        }
        
        session()->put('cart', $cart);
        
        return response()->json(true);
    }
    
    public function addToCart(AddToCart $request) {
        
        $cart = session('cart') ?? [];
        if($request->input('type') == 1) {
            $product = $this->business->getById($request->input('product'));
        } else {
            $product = $this->basketBusiness->getById($request->input('product'));
        }
        
        if(isset($cart[$product->id])) {
            $cart[$product->id] = [
                'product' => $product,
                'quantity' => session('cart')[$product->id]['quantity'] + $request->input('quantity'),
                'type' => $request->input('type')
            ];
        } else {
            $cart[$product->id] = [
                'product' => $product,
                'quantity' => $request->input('quantity'),
                'type' => $request->input('type')
            ];
        }
        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'cart' => count(session('cart'))
        ]);
    }
    
    public function updateCart(updateCart $request) {
        $items = $request->input('products');
        $cart = session('cart');
        
        foreach($items as $key => $p) {
            $p = (object)$p;
    
            if($p->type == 1) {
                $product = $this->business->getById($p->product);
            } else {
                $product = $this->basketBusiness->getById($p->product);
            }
            $cart[$product->id] = [
                'product' => $product,
                'quantity' => $p->quantity,
                'type' => $p->type
            ];
        }
        
        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'cart' => count(session('cart'))
        ]);
    }
}
