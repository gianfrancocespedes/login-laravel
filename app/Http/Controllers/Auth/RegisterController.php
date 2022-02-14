<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;

class RegisterController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(Request $request){
        $userData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = $this->userService->store($userData);

        $token = $user->createToken('my_awesome_token')->plainTextToken;

        return response()->json(['token'=>$token,'mensaje'=>"Usuario registrado con éxito"],200);
    }


}
