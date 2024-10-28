<?php

namespace App\Repositories;

use App\Interfaces\AdminRepositoriesInterface;
use App\Models\Group;
use App\Models\Member;
use App\Models\User;
use http\Env\Request;

class AdminRepository implements AdminRepositoriesInterface
{

    public function add_member(User $user, int $user_id, int $group_id)
    {
        $group = Group::find($group_id);
        if ((int)$group->user_id != $user->id) {
            return false;
        } else {
            $member = Member::create([
                'user_id' => $user_id,
                'group_id' => $group_id
            ]);
            return $member;
        }
    }

    public function delete_member(User $user, int $user_id, int $group_id)
    {
        $group = Group::find($group_id);
        if ($group->user_id != $user->id) {
            return false;
        } else {
            Member::where('user_id', $user_id)->where('group_id', $group_id)->first()->delete();
            return true;
        }
    }

    public function upload_file()
    {
        // TODO: Implement upload_file() method.
    }
}
