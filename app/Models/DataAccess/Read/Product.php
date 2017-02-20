<?php


namespace OlympicDrive\Models\DataAccess\Read;


use OlympicDrive\Models\Entities\Eloquent\Product as ProductModel;

class Product extends BaseReader {
    
    public function __construct() {
        $this->entity = ProductModel::class;
    }
    
    public function getAllWithStatus($flag) {
        return ProductModel::active($flag)->get();
    }
    
    public function getTypeArray() {
        return ProductModel::getTypeArray();
    }
    
    public function getStatusArray() {
        return ProductModel::getStatusArray();
    }
    
    public function getList() {
        $data = $this->getAll();
        $list = [];
        
        foreach($data as $product) {
            $list[$product->id] = $product->name.' / '.$product->weight.$product->getUnitstext();
        }
        
        return $list;
    }
    
    public function search($keyword, $nb) {
        $products = ProductModel::where('name', 'LIKE', '%'.$keyword.'%')
            ->paginate($nb);
        
        return $products;
    }
    
    public function getByType($type, $nb) {
        return ProductModel::where('type', $type)->take($nb)->get();
    }
}