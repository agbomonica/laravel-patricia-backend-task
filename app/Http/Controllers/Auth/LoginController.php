<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(LoginRequest $request){

        if(!auth()->attempt($request->only('email', 'password'))){
            return response([
                'status' => 'fail',
                'code' => 401,
                'message' => 'Invalid credentials',
            ])->setStatusCode(Response::HTTP_UNAUTHORIZED);
        }

        $token = auth()->user()->createToken('authToken')->accessToken;

        return response([
            'status' => 'success',
            'code' => 200,
            'message' => "You're logged in",
            'data' => new UserResource(auth()->user()),
            'access_token' => $token,
        ])->setStatusCode(Response::HTTP_OK);
    }
}


