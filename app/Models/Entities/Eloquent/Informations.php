<?php


namespace OlympicDrive\Models\Entities\Eloquent;


class Informations extends BaseModel {
    
    const COUNTRY_FRANCE = 1;
    const COUNTRY_BELGIQUE = 2;
    const COUNTRY_LUXEMBOURG= 3;
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public static function getCountryArray() {
        return [
             self::COUNTRY_FRANCE => 'France',
             self::COUNTRY_BELGIQUE => 'Belgique',
             self::COUNTRY_LUXEMBOURG => 'Luxembourg',
        ];
    }
    
    public function getCountryText($billing = false) {
        $countries = $this::getCountryArray();
        return $countries[$billing ? $this->country : $this->billing_country];
    }
    
}