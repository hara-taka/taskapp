<?php

namespace App\Services;

use App\Task;
use App\User;
use Carbon\Carbon;

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

    //一週間分のタスクの達成率の日にち
    public function oneWeekTaskAchievementDate()
    {
        for ($i = 0; $i < 7; $i++) {
            $date = date("Y-m-d", strtotime('-'.$i .'day'));
            $oneWeekTaskDate[] = $date;
        }

        $oneWeekTaskDate = array_reverse($oneWeekTaskDate);
        return $oneWeekTaskDate;
    }

    //一週間分のタスクの達成率
    public function oneWeekTaskAchievement($user_id,$oneWeekTaskDate)
    {
        for ($i = 0; $i < 7; $i++) {
            $tasks_num = Task::where('user_id',$user_id)->where('date',$oneWeekTaskDate[$i])->count();
            $achievement_tasks_num = Task::where('user_id',$user_id)->where('status',2)->count();
            if($tasks_num){
                $div = $achievement_tasks_num / $tasks_num;
                $achievment_rate = (round($div,2)) * 100;
            }else{
                $achievment_rate = 0;
            }

            $oneWeekTaskAchievement[] = $achievment_rate;
        }

        return $oneWeekTaskAchievement;
    }

    //当日の個人用タスク達成率ランキングデータ
    public function personalTaskRanking()
    {
        $user = User::all();
        $count = User::all()->count();
        $date = date('Y-m-d');

        for ($i = 0; $i < $count; $i++) {
            $tasks_num = Task::where('user_id',$user[$i]->id)->where('date',$date)->count();
            $achievement_tasks_num = Task::where('user_id',$user[$i]->id)->where('status',2)->count();
            if($tasks_num){
                $div = $achievement_tasks_num / $tasks_num;
                $achievment_rate = (round($div,2)) * 100;
            }else{
                $achievment_rate = 0;
            }

            $personalTask[$user[$i]->name] = $achievment_rate;
        }

        arsort($personalTask);
        $personalTask = array_slice($personalTask,0,5);
        return $personalTask;
    }

}