<?php

namespace App\Services;

use App\Models\User;
use http\Env\Request;

interface AdminServiceInterface
{
    public function add_member(User $user, int $user_id, int $group_id);
    public function delete_member(User $user, int $user_id, int $group_id);
    public function upload_file();
}
