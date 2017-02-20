<?php
namespace OlympicDrive\Models\DataAccess\Read;


use OlympicDrive\Models\Entities\Eloquent\User as UserModel;

class User extends BaseReader {
    
    public function __construct() {
        $this->entity = UserModel::class;
    }
    
    public function getRoles() {
        return UserModel::getRoleArray();
    }

}