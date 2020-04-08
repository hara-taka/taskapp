<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\User;
use App\Task;
use Auth;
use Hash;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function show(int $user_id)
    {
        $profile = User::find($user_id);

        //現在の年、月を取得
        $dt = Carbon::now();
        $year = $dt->year;
        $month = $dt->month;

        //カレンダー表示日の配列
        $dates = getCalendarDates($year, $month);

        //１ヶ月分のタスク達成率を達成率を表示させるための
        //カレンダーに表示させる最初の日($data)と
        //カレンダーに表示させる日数($count)
        list($date, $count) = getTaskAchievementDates($year, $month);

        //カレンダー表示用のタスク達成率の配列
        for ($i = 0; $i < $count; $i++, $date->addDay()) {
            $tasks_num = Task::where('user_id',$user_id)->where('date',$date)->count();
            $achievement_tasks_num = Task::where('user_id',$user_id)->where('status',2)->count();
            if($tasks_num){
                $div = $achievement_tasks_num / $tasks_num;
                $achievment_rate = (round($div,2)) * 100;
            }else{
                $achievment_rate = 0;
            }
            $tasks[] = $achievment_rate;
        }

        return view('profile.show',compact('profile','user_id','dates','dt','tasks'));
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

        return redirect()->route('profile.show', [
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

        return redirect()->route('profile.show', [
        'user_id' => $user_id
        ]);
    }
}
