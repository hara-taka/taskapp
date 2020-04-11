<?php

namespace App\Services;

use App\Task;

class TaskService {
    //カレンダー表示用のタスク達成率の配列
    public function calendarTaskAchievement($count,$date,$user_id)
    {
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

        return $tasks;
    }

    //達成率の計算処理
    public function taskAchievementCalculation($user_id,$today)
    {
        $tasks_num = Task::where('user_id',$user_id)->where('date',$today)->count();
        $achievement_tasks_num = Task::where('user_id',$user_id)->where('status',2)->count();
        if($tasks_num){
            $div = $achievement_tasks_num / $tasks_num;
            $achievment_rate = (round($div,2)) * 100;
        }else{
            $achievment_rate = 0;
        }

        return $achievment_rate;
    }
}