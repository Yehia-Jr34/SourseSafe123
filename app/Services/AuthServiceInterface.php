<?php

namespace App\Services;

interface AuthServiceInterface
{
    public function register();
    public function login();
    public function logout();
}
