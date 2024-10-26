<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\Group;
use App\Models\Member;
use App\Models\User;
use http\Env\Request;
use Ramsey\Uuid\Type\Integer;

class UserRepository implements UserRepositoryInterface
{

    public function get_my_groups(User $user)
    {
        $groups = [];

        $members = Member::where('user_id', $user->id)->get();

//        return $members;

        foreach ($members as $member) {
            $group = Group::where('id', $member->group_id)->get();
            $groups [] = $group;
        }
        return $groups;
    }

    public function leave_group(User $user, int $group_id)
    {
        $member = Member::where('user_id', $user->id)->where('group_id' , $group_id)->first();

        if ($member != null)
        {
            $member->delete();
            return true;
        }
        return false;
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

        Member::create([
            'group_id' => $group->id,
            'user_id' => $user->id,
        ]);

        return $group;
    }
}
