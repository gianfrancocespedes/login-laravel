<?php 

namespace App\Services;

use App\Models\User;

class UserService{
    protected $modelClass = User::class;

    public $model;

    public function __construct()
    {
        $this->model = new $this->modelClass;
    }

    public function store($attributes){
        $attributes['password'] = bcrypt($attributes['password']);

        $user = $this->model->newInstance($attributes);

        $user->save();

        return $user;
    }

}