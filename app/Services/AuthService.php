<?php

namespace App\Services;

use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\Request;

class AuthService implements AuthServiceInterface
{

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(string $name, string $email, string $password)
    {
        return $this->authRepository->register($name, $email, $password);
    }

    public function login(Request $request)
    {
        return $this->authRepository->login($request);
    }

    public function logout(Request $request)
    {
        return $this->authRepository->logout($request);
    }
}
