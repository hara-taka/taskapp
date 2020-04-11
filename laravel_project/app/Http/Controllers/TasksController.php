<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use TaskService;

class TasksController extends Controller
{
    public function index(int $user_id)
    {
        $today = date('Y-m-d');
        $tasks = Task::where('date',$today)->where('user_id',$user_id)->get();

        //達成率の計算処理
        $achievment_rate = TaskService::taskAchievementCalculation($user_id,$today);

        return view('task.index',compact('tasks','user_id','achievment_rate'));
    }


    public function store(int $user_id,Request $request)
    {
        $task = new Task();
        $task->name = $request->name;
        $task->date = date('Y-m-d');
        $task->status = $request->status;
        $task->user_id = $user_id;
        $task->save();

        return redirect()->route('tasks.index', [
        'user_id' => $user_id,
        ]);
    }


    public function edit(int $user_id, int $task_id)
    {
        $task = Task::find($task_id);

        return view('task.edit',compact('task','user_id'));
    }


    public function update(int $user_id, int $task_id, Request $request)
    {
        $task = Task::find($task_id);
        $task->name = $request->name;
        $task->status = $request->status;
        $task->save();

        return redirect()->route('tasks.index', [
        'user_id' => $user_id,
        ]);
    }

    public function destroy(int $user_id, int $task_id)
    {
        $task = Task::find($task_id);
        $task->delete();

        return redirect()->route('tasks.index', [
        'user_id' => $user_id,
        ]);
    }
}