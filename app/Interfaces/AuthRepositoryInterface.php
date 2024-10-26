<?php

namespace App\Interfaces;



use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function register(string $name, string $email, string $password);
    public function login(Request $request);
    public function logout(Request $request);
}
