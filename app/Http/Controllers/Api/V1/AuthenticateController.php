<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Dingo\Api\Routing\Helpers;

class AuthenticateController extends Controller
{
    use Helpers;

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function me()
    {
        $user = $this->auth->user();

        return $user;
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        Auth::guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        $user = $this->auth->user();
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('token'));
    }
}
