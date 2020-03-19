<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');
        $tasks = Task::where('date',$today)->get();

        //達成率の計算処理
        //$tasks_num = Task::where(date,$today)->count();
        //$achievement_tasks_num = Task::where(status,)->count();
        //$div = $achievement_tasks_num / $tasks_num;
        //$achievment_rate = (round($div,2)) * 100;

        return view('task.index',compact('tasks'));
    }
}
