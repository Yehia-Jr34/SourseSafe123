<?php

namespace App\Interfaces;

use App\Models\User;
use http\Env\Request;
use Ramsey\Uuid\Type\Integer;

interface UserRepositoryInterface
{
    public function get_my_groups(User $user);
    public function add_group(User $user, string $name);
    public function leave_group(Integer $group_id);
    public function upload_file();
    public function download_file();

}
