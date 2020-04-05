<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\User;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function index(int $user_id)
    {
        $profile = User::find($user_id);

        return view('profile.index',compact('profile','user_id'));
    }

    public function edit(int $user_id)
    {
        $profile = User::find($user_id);

        return view('profile.edit',compact('profile','user_id'));
    }

    public function update(int $user_id, ProfileRequest $request)
    {
        $profile = User::find($user_id);
        $profile->name = $request->name;
        $profile->gender = $request->gender;
        $profile->age = $request->age;
        $profile->comment = $request->comment;
        if($request->hasFile('image')){
            if($request->file('image')->isValid()) {
                $path = $request->file('image')->store('public');
                $profile->image = basename($path);
            }
        }
        $profile->save();

        return redirect()->route('profile.index', [
        'user_id' => $user_id
        ]);
    }

    public function editPassword(int $user_id)
    {
        return view('profile.editPassword',compact('user_id'));
    }

    public function updatePassword(int $user_id, passwordRequest $request)
    {
        $profile = User::find($user_id);
        $password = $profile->password;
        if (!(Hash::check($request->current_password, $password))) {
            return redirect()->back()->with('error', '現在のパスワードが間違っています。');
        }


        $profile = User::find($user_id);
        $profile->password = Hash::make($request->new_password);
        $profile->save();

        return redirect()->route('profile.index', [
        'user_id' => $user_id
        ]);
    }
}
