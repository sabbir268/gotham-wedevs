<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRquest;
use App\Http\Requests\RegisterRquest;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Register user via api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRquest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($request->password);
        if (User::create($data)) {
            if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
                return response(['message' => 'Invalid credentials']);
            }

            $accessToken = auth()->user()->createToken('authToken')->accessToken;

            return response(['user' => auth()->user(), 'access_token' => $accessToken, 'message' => 'success']);
        }
    }


    public function login(LoginRquest $request)
    {
        if (!auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response(['message' => 'Invalid credentials']);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken, 'message' => 'success']);
    }
}
