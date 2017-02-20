<?php

namespace OlympicDrive\Http\Controllers;

use Illuminate\Http\Request;
use OlympicDrive\Http\Requests\CreateBasket;
use OlympicDrive\Http\Requests\UpdateBasket;
use OlympicDrive\Models\Business\Basket;
use OlympicDrive\Models\Business\Product;

class BasketController extends Controller
{
    
    private $business;
    private $productBusiness;
    private $limit;
    
    public function __construct() {
        $this->business = new Basket();
        $this->limit = 12;
        $this->productBusiness = new Product();
    }
    
    public function index(Request $request) {
        if($request->is('admin/*')) {
            $baskets = $this->business->paginate(10);
    
            return view('back.baskets.index')
                ->with('baskets', $baskets);
        } else {
            $baskets = $this->business->paginate($this->limit, [1]);
    
            return view('front.shop.baskets')
                ->with('products', $baskets);
        }
    }
    
    public function create() {
        $status = $this->business->getStatusArray();
        $product = $this->productBusiness->getList();
        
        return view('back.baskets.create')
            ->with('products', $product)
            ->with('status', $status);
    }
    
    public function store(CreateBasket $request) {
        $basket = $this->business->create($request);
    
        if (!$basket instanceof Exception) {
            return redirect()->route('baskets.index')
                ->with('flash', [
                    'code'    => $this::SUCCESS,
                    'message' => 'Le panier "' . $basket->name . '" a été ajouté avec success'
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
        $basket = $this->business->getById($id);
    
        return view('front.shop.basket')
            ->with('product', $basket);
    }
    
    public function edit($id) {
        $basket = $this->business->getById($id);
        $status = $this->business->getStatusArray();
        $product = $this->productBusiness->getList();
    
        return view('back.baskets.edit')
            ->with('basket', $basket)
            ->with('products', $product)
            ->with('status', $status);
    }
    
    public function update(UpdateBasket $request, $id) {
        $basket = $this->business->update($request, $id);
    
        if (!$basket instanceof Exception) {
            return redirect()->route('baskets.index')
                ->with('flash', [
                    'code'    => $this::SUCCESS,
                    'message' => 'Le panier "' . $basket->name . '" a été modifié avec success'
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
            return redirect()->route('baskets.index')
                ->with('flash', [
                    'code'    => $this::SUCCESS,
                    'message' => 'Le produit a bien été supprimé.'
                ]);
        }
    
        return redirect()->route('baskets.index')
            ->with('flash', [
                'code'    => $this::ERROR,
                'message' => 'Une erreur est survenue lors de la suppression.'
            ]);
    }
}
