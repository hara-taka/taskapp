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
}
