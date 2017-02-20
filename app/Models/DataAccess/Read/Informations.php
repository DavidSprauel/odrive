<?php


namespace OlympicDrive\Models\DataAccess\Read;


use OlympicDrive\Models\Entities\Eloquent\Informations as InformationsModel;

class Informations extends BaseReader {
    
    public function __construct() {
        $this->entity = InformationsModel::class;
    }
    
    public function getCountryArray() {
        return InformationsModel::getCountryArray();
    }
}