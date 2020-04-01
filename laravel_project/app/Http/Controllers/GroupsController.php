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

        $group_member_num = $group->group_members->count();

        $members = GroupMember::where('group_id',$group_id)->get();

        return view('group.details',compact('group','members','group_member_num'));
    }

    public function participate(int $group_id)
    {
        $user_id = Auth::id();
        $group_member_num = $group->group_members->count();

        if($group_member_num < 5){
            $group_member = new GroupMember();
            $group_member->group_id = $group_id;
            $group_member->user_id = $user_id;
            $group_member->save();
        }

        return redirect()->route('groups.index');
    }
}
