<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use App\Services\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
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

        $user = $this->authService->register($request->name, $request->email, $request->password);

        return response()->json(['user' => $user], 201);
    }

    // Login user
    public function login(Request $request)
    {
        $auth = $this->authService->login($request);

        if ($auth != null) {
            return response()->json(['access_token' => $auth, 'token_type' => 'Bearer'], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Logout user
    public function logout(Request $request)
    {
        $this->authService->logout($request);
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
