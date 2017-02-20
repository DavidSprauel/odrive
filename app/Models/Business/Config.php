<?php


namespace OlympicDrive\Models\Business;


use OlympicDrive\Models\DataAccess\Read\Config as ConfigRead;
use OlympicDrive\Models\DataAccess\Write\Config as ConfigWrite;

class Config extends BaseBusiness {
    protected $write;
    protected $read;
    
    public function __construct() {
        $this->write = new ConfigWrite();
        $this->read = new ConfigRead();
    }
}