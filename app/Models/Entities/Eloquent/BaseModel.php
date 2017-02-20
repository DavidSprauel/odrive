<?php


namespace OlympicDrive\Models\Entities\Eloquent;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {
    
    protected $dates = ['created_at', 'updated_at'];
    
    public function setCreatedAtAttribute($date) {
        $this->attributes['created_at'] = new Carbon($date);
    }
    
    public function setUpdatedAtAttribute($date) {
        $this->attributes['updated_at'] = new Carbon($date);
    }
    
    public function getCreatedAtAttribute($date) {
        return new Carbon($date);
    }
    
    public function getUpdatedAtAttribute($date) {
        return new Carbon($date);
    }
    
    public function getFrenchMonth($value) {
        switch($value) {
            case '01':
                return 'Janvier';
            case '02':
                return 'Février';
            case '03':
                return 'Mars';
            case '04':
                return 'Avril';
            case '05':
                return 'May';
            case '06':
                return 'Juin';
            case '07':
                return 'Juillet';
            case '08':
                return 'Août';
            case '09':
                return 'Septembre';
            case '10':
                return 'Octobre';
            case '11':
                return 'Novembre';
            case '12':
                return 'Décembre';
        }
    }
    
    public function getFrenchDays($value) {
        switch($value) {
            case 'Monday':
                return 'Lundi';
            case 'Tuesday':
                return 'Mardi';
            case 'Wednesday':
                return 'Mercredi';
            case 'Thursday':
                return 'Jeudi';
            case 'Friday':
                return 'Vendredi';
            case 'Saturday':
                return 'Samedi';
            case 'Sunday':
                return 'Dimanche';
        }
    }
    
    public function formatFrenchDate($date = 'created') {
        if($date == 'created'){
            $dateBase = $this->created_at;
        } else {
            $dateBase = $this->updated_at;
        }
        $date = $dateBase->format('Y-m-l');
        $dateCutted = explode('-', $date);
        $day = $this->getFrenchDays($dateCutted[2]);
        $month = $this->getFrenchMonth($dateCutted[1]);
    
        return $day.' '.$dateBase->format('d'). ' '.$month. ' ' .$dateCutted[0];
    }
}