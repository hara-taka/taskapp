<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Task;
use Auth;
use TaskService;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(int $user_id,$date='today')
    {
        if(Auth::id() !== $user_id){

            return redirect()->back();

        } else {
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

    }

    public function store(int $user_id,TaskRequest $request,$date)
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
        if(Auth::id() !== $user_id){

            return redirect()->back();

        } else {
            $task = Task::find($task_id);

            return view('task.edit',compact('task','user_id','date'));
        }

    }

    public function update(int $user_id, int $task_id, TaskRequest $request,$date)
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
        //ランキング（個人当日）
        list($personalTodayName, $personalTodayTask, $personalTodayRank) = TaskService::personalTaskRanking();

        //ランキング（個人一週間）
        list($personalOneWeekName, $personalOneWeekTask, $personalOneWeekRank) = TaskService::personalOneWeekTaskRanking();

        //ランキング（グループ当日）
        list($groupTodayName, $groupTodayTask, $groupTodayRank) = TaskService::groupTodayTaskRanking();

        //ランキング（グループ一週間）
        list($groupOneWeekName, $groupOneWeekTask, $groupOneWeekRank) = TaskService::groupOneWeekTaskRanking();

        $user_id = Auth::id();

        return view('ranking.show',compact(
        'personalTodayName','personalTodayTask','personalTodayRank',
        'personalOneWeekName','personalOneWeekTask','personalOneWeekRank',
        'groupTodayName','groupTodayTask','groupTodayRank',
        'groupOneWeekName','groupOneWeekTask','groupOneWeekRank','user_id'
        ));
    }

}