<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Group;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function view_my_groups(Request $request)
    {
        $user = $request->user();

        $groups = Group::where('admin', $user->id)->get()->map(function ($group) {
            $group->created_at_formatted = Carbon::parse($group->created_at)->format('d-m-Y H:i:s');
            $group->updated_at_formatted = Carbon::parse($group->updated_at)->format('d-m-Y H:i:s');
            return $group;
        });

        return response()->json([
            'message' => 'done',
            'data' => $groups
        ]);
    }

    public function add_member(Request $request)
    {
        $user = $request->user();

        $group = Group::find($request->group_id);

        if ($group->admin != $user->id) {
            return response()->json([
                'message' => 'you can not do this process'
            ]);
        } else {
            $member = Member::create([
                'group_id' => $group->id,
                'user_id' => $request->user_id
            ]);

            $member->created_at_formatted = Carbon::parse($member->created_at)->format('d-m-Y H:i:s');
            $member->updated_at_formatted = Carbon::parse($member->updated_at)->format('d-m-Y H:i:s');

            return response()->json([
                'message' => 'done',
                'member' => $member
            ]);
        }
    }

    public function delete_member(Request $request)
    {
        $user = $request->user();

        $group = Group::find($request->group_id);

        if ($group->admin != $user->id) {
            return response()->json([
                'message' => 'you can not do this process'
            ]);
        } else {
            $member = Member::where('user_id', $request->member_id)->where('group_id', $group->id)->first();

            if ($member == null) {
                return response()->json([
                    'message' => 'this user is not a member of this group'
                ]);
            } else {
                $member->delete();

                return response()->json([
                    'message' => 'member deleted'
                ]);
            }
        }
    }

    public function upload_file(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'file' => 'required|file|max:2048',
        ]);

        if ($request->file('file')->isValid()) {
            $originalName = pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME);

            $file = File::create([
                'name' => $originalName,
                'added_by' => $user->id,
                'group_id' => $request->group_id,
            ]);

            $folderPath = "uploads/{$originalName}/{$file->numberOfVersions}";

            $path = $request->file('file')->storeAs($folderPath, $originalName, 'public');
            $file->path = $path;
            $file->save();

            return response()->json([
                'message' => 'new file added',
                'file' => $file
            ]);
        }

        return response()->json([
            'message' => 'File upload failed'
        ]);
    }
}
