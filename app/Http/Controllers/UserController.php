<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function create_group(Request $request)
    {
        $user = $request->user();


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:64|min:4|unique:groups',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $group = Group::create([
            'name' => $request->name,
            'admin' => $user->id
        ]);

        return response()->json([
            'message' => 'Group created successfully',
            'group' => $group
        ]);
    }

    public function get_my_groups(Request $request)
    {
        $user = $request->user();

        $members = Member::where('user_id', $user->id)->get();

        $groups = [];

        foreach ($members as $member) {
            $group = Group::where('id', $member->group_id)->get();
            $groups [] = $group;
        }

        return response()->json([
            'message' => 'done',
            'groups' => $groups
        ]);
    }

    public function leave_group(Request $request)
    {
        $user = $request->user();

        $member = Member::where('user_id', $user->id)->where('group_id', $request->group_id)->first();

        $member->delete();

        return response()->json([
            'message' => 'you have just left the group',
        ]);
    }

}
