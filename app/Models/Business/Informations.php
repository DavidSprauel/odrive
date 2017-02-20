<?php


namespace OlympicDrive\Models\Business;


use OlympicDrive\Models\DataAccess\Read\Informations as InformationsRead;
use OlympicDrive\Models\DataAccess\Write\Informations as InformationsWrite;

class Informations extends BaseBusiness {
    
    public function __construct() {
        $this->read = new InformationsRead();
        $this->write = new InformationsWrite();
    }
    
    public function create(array $infos) {
        return $this->write->create($infos);
    }
    
    public function getCountryArray() {
        return $this->read->getCountryArray();
    }
    
    public function save($infos) {
        return $this->write->save($infos);
    }
}