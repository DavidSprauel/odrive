<?php


namespace OlympicDrive\Models\DataAccess\Read;


use OlympicDrive\Models\Entities\Eloquent\Basket as BasketModel;

class Basket extends BaseReader {
    
    public function __construct() {
        $this->entity = BasketModel::class;
    }
    
    public function getStatusArray() {
        return BasketModel::getStatusArray();
    }
}