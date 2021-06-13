<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class SignUpController extends Controller
{
    public function store(SignUpRequest $request){
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' =>    $request->email,
            'password' => Hash::make($request->password),
        ]);

        if(!$user){
            return response([
                'status' => 'fail',
                'code' => 400,
                'message' => "Unable to create user",
            ])->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return response([
            'status' => 'success',
            'code' => 201,
            'message' => 'User created successfully',
            'data' => new UserResource($user),
        ])->setStatusCode(Response::HTTP_CREATED);
    }
}
