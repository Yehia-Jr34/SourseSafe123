<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Member;
use App\Services\AdminServiceInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(AdminServiceInterface $adminService)
    {
        $this->adminService = $adminService;
    }

    public function add_member(Request $request)
    {
        $user = $request->user();

        $answer = $this->adminService->add_member($user, $request->user_id, $request->group_id);

        if (!$answer) {
            return response()->json([
                'message' => 'you are not able to do this process'
            ]);
        } else {
            return response()->json([
                'message' => 'User added to the group',
                'member' => $answer
            ]);
        }
    }

    public function delete_member(Request $request)
    {
        $user = $request->user();

        $answer = $this->adminService->delete_member($user, $request->user_id, $request->group_id);

        if (!$answer) {
            return response()->json([
                'message' => "You are not able to do this process"
            ]);
        } else {
            return response()->json([
                'message' => 'User deleted from the group',
            ]);
        }
    }
}
