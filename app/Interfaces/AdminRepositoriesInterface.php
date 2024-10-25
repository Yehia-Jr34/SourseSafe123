<?php

namespace App\Interfaces;

use http\Env\Request;

interface AdminRepositoriesInterface
{
    public function add_member(Request $request);
    public function delete_member();
    public function upload_file();
}
