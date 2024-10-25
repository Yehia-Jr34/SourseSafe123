<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function add_group(Request $request)
    {
        $user = $request->user();

        $group = $this->userService->add_group($user, $request->name);

        return response()->json([
            'message' => 'Group created successfully',
            'group' => $group
        ]);

    }

}
