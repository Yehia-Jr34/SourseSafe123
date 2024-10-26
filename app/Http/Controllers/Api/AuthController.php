<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authReporitory = $authRepository;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = $this->authReporitory->register($request->name, $request->email, $request->password);

        return response()->json(['user' => $user], 201);
    }

    // Login user
    public function login(Request $request)
    {
        $auth = $this->authReporitory->login($request);

        if ($auth != null) {
            return response()->json(['access_token' => $auth, 'token_type' => 'Bearer'], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Logout user
    public function logout(Request $request)
    {
        $this->authReporitory->logout($request);
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
