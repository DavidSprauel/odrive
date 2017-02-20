<?php


namespace OlympicDrive\Models\Business;


use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use OlympicDrive\Http\Requests\CreateProduct;
use OlympicDrive\Http\Requests\UpdateProduct;
use OlympicDrive\Models\DataAccess\Read\Product as ProductRead;
use OlympicDrive\Models\DataAccess\Write\Product as ProductWrite;
use OlympicDrive\Models\Entities\Eloquent\Product as ProductModel;

class Product extends BaseBusiness{
    protected $write;
    protected $read;
    
    public function __construct() {
        $this->write = new ProductWrite();
        $this->read = new ProductRead();
    }
    
    public function getTypeArray() {
        return $this->read->getTypeArray();
    }
    
    public function create(CreateProduct $request) {
        try {
            if($request->input('taxes') === 'on' ) {
                $taxes = 1;
            } else {
                $taxes = 0;
            }
            
            $product = [
                'type' => $request->input('type'),
                'status' => $request->input('status'),
                'name' => $request->input('name'),
                'weight' => $request->input('weight'),
                'units' => $request->input('units'),
                'price' => $request->input('price'),
                'origin' => $request->input('origin'),
                'reference' => $request->input('reference'),
                'created_at' => new Carbon('now'),
                'taxes' => $taxes,
            ];
            
            if(!$this->write->create($product)) {
                return null;
            }
    
            $product = $this->read->getLastItems(1);
        
            if($request->hasFile('picture')) {
                $product->picture = $this->uploadPicture($request->file('picture'), $product, 'products');
            }
    
            $this->write->save($product);
            
            return $product;
        } catch (Exception $e) {
            return $e;
        }
        
        
        return $this->write->create($request);
    }
    
    public function update(UpdateProduct $request, $id) {
        try {
            $product = $this->read->getById($id);
            if(is_null($product)) {
                throw new Exception('Le produit demandé est introuvable.', 404);
            }
            
            $product->type = $request->input('type');
            $product->name = $request->input('name');
            $product->weight = $request->input('weight');
            $product->units = $request->input('units');
            $product->price = $request->input('price');
            $product->origin = $request->input('origin');
            $product->reference = $request->input('reference');
            if($request->input('taxes') === 'on' ) {
                $taxes = 1;
            } else {
                $taxes = 0;
            }
            $product->taxes = $taxes;
        
            if($request->hasFile('picture')) {
                $product->picture = $this->uploadPicture($request->file('picture'), $product, 'products');
            }
        
            $product = $this->write->save($product);
            
            return $product;
        } catch (Exception $e) {
            return $e;
        }
        return false;
        
        return $this->write->save($product);
    }
    
    public function getAllWithStatus($flag) {
        return $this->read->getAllWithStatus($flag);
    }
    
    public function getStatusArray() {
        return $this->read->getStatusArray();
    }
    
    public function getLastProducts() {
        return $this->read->getLastItems(5);
    }
    
    public function search(Request $request, $nb) {
        return $this->read->search($request->input('search'), $nb);
    }
    
    public function getRelatedProducts(ProductModel $product) {
        return $this->read->getByType($product->type, 4);
    }
}