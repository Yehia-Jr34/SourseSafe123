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
        // TODO: Implement get_my_groups() method.
    }

    public function leave_group(Integer $group_id)
    {
        // TODO: Implement leave_group() method.
    }

    public function upload_file()
    {
        // TODO: Implement upload_file() method.
    }

    public function download_file()
    {
        // TODO: Implement download_file() method.
    }

    public function add_group(User $user, string $name)
    {
        return $this->userRepository->add_group($user, $name);
    }
}
