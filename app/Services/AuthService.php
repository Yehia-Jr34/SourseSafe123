<?php

namespace App\Services;

use App\Interfaces\AuthRepositoryInterface;

class AuthService implements AuthServiceInterface
{

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register()
    {
        return $this->authRepository->register();
    }

    public function login()
    {
        return $this->authRepository->login();
    }

    public function logout()
    {
        return $this->authRepository->logout();
    }
}
