<?php
namespace OlympicDrive\Models\DataAccess\Write;


use Exception;
use Illuminate\Support\Facades\Hash;
use OlympicDrive\Http\Requests\ActiveUser;
use OlympicDrive\Http\Requests\CreateUser;
use OlympicDrive\Http\Requests\EditUser;
use OlympicDrive\Models\Entities\Eloquent\User as UserModel;

class User extends BaseWriter {
    
    public function __construct() {
        $this->entity = UserModel::class;
    }
    
}