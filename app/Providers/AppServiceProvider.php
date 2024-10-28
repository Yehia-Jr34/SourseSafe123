<?php

namespace App\Providers;

use App\Interfaces\AdminRepositoriesInterface;
use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\AdminRepository;
use App\Repositories\AuthRepository;
use App\Repositories\UserRepository;
use App\Services\AdminService;
use App\Services\AdminServiceInterface;
use App\Services\AuthService;
use App\Services\AuthServiceInterface;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(UserServiceInterface::class,UserService::class);

        $this->app->bind(AuthRepositoryInterface::class,AuthRepository::class);
        $this->app->bind(AuthServiceInterface::class,AuthService::class);

        $this->app->bind(AdminRepositoriesInterface::class,AdminRepository::class);
        $this->app->bind(AdminServiceInterface::class,AdminService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
