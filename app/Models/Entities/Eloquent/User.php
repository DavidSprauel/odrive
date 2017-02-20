<?php

namespace OlympicDrive\Models\Entities\Eloquent;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    
    use Notifiable;
    
    protected $fillable = [
        'lastname', 'firstname', 'email', 'password',
    ];
    
    protected $dates = ['created_at', 'updated_at'];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    const ROLE_ADMIN = 1;
    const ROLE_EDITOR = 2;
    const ROLE_CLIENT = 3;
    const ROLE_GUEST = 0;
    
    const USER_ACTIVE = 1;
    const USER_INACTIVE = 0;
    
    public function informations() {
        return $this->hasOne(Informations::class);
    }
    
    public function isAdmin() {
        return $this->role_id == $this::ROLE_ADMIN;
    }
    
    public function isAdminOrEditor() {
        return $this->role_id == $this::ROLE_ADMIN || $this->role_id == $this::ROLE_EDITOR ;
    }
    
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
    
    public function getRoleText() {
        $roles = $this::getRoleArray();
        return $roles[$this->role_id];
    }
    
    public function getActiveText() {
        $roles = $this::getActiveArray();
        return $roles[$this->active];
    }
    
    public function getFullName() {
        return $this->firstname.' '.$this->lastname;
    }
    
    public static function getRoleArray() {
        return [
            self::ROLE_ADMIN  => 'Admin',
            self::ROLE_EDITOR => 'Editeur',
            self::ROLE_CLIENT => 'Client',
//            self::ROLE_GUEST => 'Guest'
        ];
    }
    
    public static function getActiveArray() {
        return [
            self::USER_ACTIVE  => 'Actif',
            self::USER_INACTIVE => 'Inactif',
        ];
    }
}
