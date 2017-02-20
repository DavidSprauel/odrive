<?php


namespace OlympicDrive\Models\DataAccess\Write;


use OlympicDrive\Models\Entities\Eloquent\Basket as BasketModel;

class Basket extends BaseWriter {
    
    public function __construct() {
        $this->entity = BasketModel::class;
    }
}