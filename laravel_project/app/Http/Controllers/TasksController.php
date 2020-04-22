<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use TaskService;

class TasksController extends Controller
{
    public function index(int $user_id,$date='today')
    {
        if($date == 'today'){
            $date = date('Y-m-d');
            $tasks = Task::where('date',$date)->where('user_id',$user_id)->get();
        } else {
             $date = substr($date, 0, 10);
             $tasks = Task::where('date',$date)->where('user_id',$user_id)->get();
        }

        //達成率の計算処理
        $achievment_rate = TaskService::taskAchievementCalculation($user_id,$date);

        return view('task.index',compact('tasks','user_id','achievment_rate','date'));
    }

    public function store(int $user_id,Request $request,$date)
    {
            $task = new Task();
            $task->name = $request->name;
            $task->date = $date;
            $task->status = $request->status;
            $task->user_id = $user_id;
            $task->save();

        return redirect()->route('tasks.index', [
        'user_id' => $user_id,'date' => $date
        ]);
    }


    public function edit(int $user_id, int $task_id,$date)
    {
        $task = Task::find($task_id);

        return view('task.edit',compact('task','user_id','date'));
    }

    public function update(int $user_id, int $task_id, Request $request,$date)
    {
        $task = Task::find($task_id);
        $task->name = $request->name;
        $task->status = $request->status;
        $task->save();

        return redirect()->route('tasks.index', [
        'user_id' => $user_id, 'date' => $date
        ]);
    }

    public function destroy(int $user_id, int $task_id,$date)
    {
        $task = Task::find($task_id);
        $task->delete();

        return redirect()->route('tasks.index', [
        'user_id' => $user_id,'date' => $date
        ]);
    }

    public function showRanking()
    {
        //当日の個人用タスク達成率ランキングデータ
        $personalTask = TaskService::personalTaskRanking();

        return view('ranking.show',compact('personalTask'));
    }

}