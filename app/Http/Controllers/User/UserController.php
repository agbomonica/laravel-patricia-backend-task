<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function show(){

        return response([
            'status' => "success",
            'code' => 200,
            'data' => new UserResource(auth()->user()),
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function update(UpdateUserRequest $request){

        if(auth()->user()->update([
            'name' => $request->name,
            'email' =>    $request->email,
        ])){
            return response([
                'status' => 'success',
                'code' => 200,
                'message' => "User profile successfully updated",
                'data' => new UserResource(auth()->user()),
            ])->setStatusCode(Response::HTTP_OK);
        }

        return response([
            'status' => 'fail',
            'code' => 400,
            'message' => 'Unable to update profile',
        ])->setStatusCode(Response::HTTP_BAD_REQUEST);
    }

    public function destroy(){

        auth()->user()->delete();

        return response([
            'status' => 'success',
            'code' => 204,
            'message' => 'Account deleted successfully',
        ])->setStatusCode(Response::HTTP_NO_CONTENT);

    }
}
