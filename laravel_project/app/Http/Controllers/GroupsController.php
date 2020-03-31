<?php

namespace App\Http\Controllers;
use App\Group;

use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function index()
    {
        $groups = Group::all();

        return view('group.index',compact('groups'));
    }

    public function create()
    {
        return view('group.create');
    }

    public function store(Request $request)
    {
        $group = new Group();
        $group->name = $request->name;
        $group->category = $request->category;
        $group->comment = $request->comment;
        $group->save();

        return redirect()->route('groups.index');
    }

    public function details(int $group_id)
    {
        $group = Group::find($group_id);

        $group_member_num = GroupMember::where('group_id',$group_id)->count();

        $member = User::with('group_members')->get();

        return view('group.details',compact('group','group_id','member','group_member_num'));
    }

    public function participate(int $group_id)
    {
        $usr_id = Auth::id();
        $group_member_num = GroupMember::where('group_id',$group_id)->count();

        if($group_member_num < 6){
            $group_member = new GroupMember();
            $group_member->group_id = $group_id;
            $group_member->user_id = $usr_id;
            $group_member->save();
        }

        return redirect()->route('groups.index');
    }
}
