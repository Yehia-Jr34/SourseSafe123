<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Response;
use Ramsey\Uuid\Type\Integer;

interface UserServiceInterface
{
    public function get_my_groups(User $user);
    public function add_group(User $user, string $name);

    public function leave_group(User $user, int $group_id);
    public function upload_file();
    public function download_file();
}
