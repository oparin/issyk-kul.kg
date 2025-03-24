<?php

namespace App\Http\API\Controllers;

use App\Http\API\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:191',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error', $validator->errors(), 422);
        }

        $data = $validator->validated();

        $user = User::query()->create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $this->sendSuccess('Registration was successful', UserResource::make($user));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation error', $validator->errors(), 422);
        }

        $data = $validator->validated();

        $user = User::query()->where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return $this->sendError('The provided credentials are incorrect.', null, 401);
        }

        $authToken = $user->createToken($data['email'])->plainTextToken;

        return $this->sendSuccess('Login successfully', ['token' => $authToken]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();

        return $this->sendSuccess('Logged out');
    }
}
