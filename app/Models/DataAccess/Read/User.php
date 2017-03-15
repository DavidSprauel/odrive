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
    
    public function paginateUsers($n) {
        return UserModel::whereIn('active', [UserModel::USER_ACTIVE, UserModel::USER_INACTIVE])
                ->paginate($n);
    }
    
    public function getAdmin() {
        return UserModel::whereIn('role_id', [UserModel::ROLE_ADMIN, UserModel::ROLE_EDITOR])
            ->get();
    }

}