<?php

namespace App\Services;


use Illuminate\Http\Request;

interface AuthServiceInterface
{
    public function register(string $name, string $email, string $password);
    public function login(Request $request);
    public function logout(Request $request);
}
