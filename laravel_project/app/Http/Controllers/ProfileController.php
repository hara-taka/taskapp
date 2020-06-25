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
use TaskService;
use CalendarService;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(int $user_id,$dt='this_month',$change_month='this_month')
    {
        if(Auth::id() !== $user_id){

            return redirect()->back();

        }

        $profile = User::find($user_id);

        //カレンダー表示用の年、月の取得
        //カレンダー前月、翌月表示処理
        $dt = CalendarService::calendarDate($dt,$change_month);

        $year = $dt->year;
        $month = $dt->month;

        //カレンダー表示日の配列
        $dates = CalendarService::calendarShowDates($year, $month);

        //カレンダー表示用タスク達成率に必要な情報を取得
        //$data:カレンダーに表示させる最初の日
        //$count:カレンダーに表示させる日数
        list($date, $count) = CalendarService::calendarTaskAchievementDates($year, $month);

        //カレンダー表示用のタスク達成率の配列
        $tasks = TaskService::calendarTaskAchievement($count,$date,$user_id);

        //一週間分のタスクの達成率の日にち
        $oneWeekTaskDate = TaskService::oneWeekTaskAchievementDate();

        //一週間分のタスクの達成率
        $oneWeekTaskAchievement = TaskService::oneWeekTaskAchievement($user_id,$oneWeekTaskDate);

         //月単位のタスクの達成率の日にち
        $monthTaskDate = TaskService::monthTaskAchievementDate();

        //月単位のタスクの達成率
        $monthTaskAchievement = TaskService::monthTaskAchievement($user_id);

        return view('profile.show',
        compact('profile','user_id','dates','dt','tasks','oneWeekTaskDate','oneWeekTaskAchievement','monthTaskDate','monthTaskAchievement'));

    }

    public function edit(int $user_id)
    {
        if(Auth::id() !== $user_id){

            return redirect()->back();

        }

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
        $profile->email = $request->email;
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
        if(Auth::id() !== $user_id){

            return redirect()->back();

        }

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
