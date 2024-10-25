<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Group;
use App\Models\User;
use http\Env\Request;
use Ramsey\Uuid\Type\Integer;

class UserRepository implements UserRepositoryInterface
{

    public function get_my_groups(User $user)
    {

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
        $group = Group::create([
            'name' => $name,
            'user_id' => $user->id
        ]);
        return $group;
    }
}
