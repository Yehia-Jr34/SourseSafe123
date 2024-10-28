<?php

namespace App\Services;

use App\Interfaces\AdminRepositoriesInterface;
use App\Models\User;
use http\Env\Request;

class AdminService implements AdminServiceInterface
{
    public function __construct(AdminRepositoriesInterface $adminRepositories)
    {
        return $this->adminRepository = $adminRepositories;
    }

    public function add_member(User $user, int $user_id, int $group_id)
    {
        return $this->adminRepository->add_member($user, $user_id, $group_id);
    }

    public function delete_member(User $user, int $user_id, int $group_id)
    {
        return $this->adminRepository->delete_member($user, $user_id, $group_id);
    }

    public function upload_file()
    {
        $this->adminRepository->upload_file();
    }
}
