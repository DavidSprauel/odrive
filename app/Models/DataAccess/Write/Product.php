<?php


namespace OlympicDrive\Models\DataAccess\Write;


use OlympicDrive\Models\Entities\Eloquent\Product as ProductModel;

class Product extends BaseWriter {
    
    public function __construct() {
        $this->entity = ProductModel::class;
    }
}