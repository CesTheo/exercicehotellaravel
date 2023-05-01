<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }

    public function login(LoginRequest $loginRequest){
        return $this->authService->login($loginRequest);
    }

    public function currentUser(Request $request){
        return $this->authService->getUser($request);
    }

    public function destroyToken(Request $request){
        return $this->authService->destroyToken($request);
    }

    public function isLogin(){
        return $this->authService->isLogin();
    }

}
