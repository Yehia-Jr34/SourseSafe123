<?php

namespace App\Services;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Ramsey\Uuid\Type\Integer;

class UserService implements UserServiceInterface
{

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function get_my_groups(User $user)
    {
        return $this->userRepository->get_my_groups($user);
    }

    public function leave_group(User $user ,int $group_id)
    {
        return $this->userRepository->leave_group($user, $group_id);
    }

    public function upload_file()
    {
        return $this->userRepository->upload_file();
    }

    public function download_file()
    {
        return $this->userRepository->download_file();
    }

    public function add_group(User $user, string $name)
    {
        return $this->userRepository->add_group($user, $name);
    }
}
