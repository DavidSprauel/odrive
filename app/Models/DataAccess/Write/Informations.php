<?php


namespace OlympicDrive\Models\DataAccess\Write;


use OlympicDrive\Models\Entities\Eloquent\Informations as InformationsModel;

class Informations extends BaseWriter {
    
    public function __construct() {
        $this->entity = InformationsModel::class;
    }
}