<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

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

    public function get_my_groups(Request $request)
    {
        $user = $request->user();

        $groups = $this->userService->get_my_groups($user);

        return response()->json([
            'message' => 'done',
            'groups' => $groups
        ]);
    }

    public function leave_group(Request $request)
    {
        $user = $request->user();

        $res = $this->userService->leave_group($user, (int)$request->group_id);

        if ($res == true) {
            return response()->json([
                'message' => 'you have left the group successfully'
            ]);
        } else {
            return response()->json([
                'message' => 'error: you are not a member in this group'
            ]);
        }
    }
}
