<?php

namespace App\Services;

use App\Task;
use App\User;
use App\GroupMember;
use App\Group;
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

    //ランキング（個人当日）
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

            $personalTodayData[$user[$i]->name] = $achievment_rate;
        }

        arsort($personalTodayData);
        $personalTodayData = array_slice($personalTodayData,0,5);

        return $personalTodayData;
    }

    //ランキング（個人一週間）
    public function personalOneWeekTaskRanking()
    {
        $user = User::all();
        $count = User::all()->count();

        //一週間分の日付の配列
        for($i = 0; $i > -7; $i--){
            $date[] = date("Y-m-d",strtotime("$i day"));
        }

        //ユーザーごと一週間の繰り返し処理
        for($j = 0; $j < $count; $j++) {
            for ($i = 0; $i < 7; $i++) {
                $tasks_num = Task::where('user_id',$user[$j]->id)->where('date',$date[$i])->count();
                $achievement_tasks_num = Task::where('user_id',$user[$j]->id)->where('status',2)->count();
                if($tasks_num){
                    $div = $achievement_tasks_num / $tasks_num;
                    $achievment_rate = (round($div,2)) * 100;
                }else{
                    $achievment_rate = 0;
                }

                $oneWeektaskData[] = $achievment_rate;
            }


            $taskData = round((array_sum($oneWeektaskData))/7);
            $personalOneWeekData[$user[$j]->name] = $taskData;
            $oneWeektaskData = [];
        }

        arsort($personalOneWeekData);
        $personalOneWeekData = array_slice($personalOneWeekData,0,5);

        return $personalOneWeekData;
    }

    //ランキング（グループ当日）
    public function groupTodayTaskRanking()
    {
        $group = Group::all();
        $groupCount = Group::all()->count();
        $date = date('Y-m-d');

        //各グループの人数の配列
        for($i = 0; $i < $groupCount; $i++){
            $groupMemberCount[] =  GroupMember::where('group_id',$i+1)->count();
        }

        //各グループのメンバーの配列
        for($i = 0; $i < $groupCount; $i++){
            $groupMember[] =  GroupMember::where('group_id',$i+1)->get();
        }

        for($i = 0; $i < $groupCount; $i++) {
            $count = $groupMemberCount[$i];
            for ($j = 0; $j < $count; $j++) {
                $tasks_num = Task::where('user_id',$groupMember[$i][$j]->user_id)->where('date',$date)->count();
                $achievement_tasks_num = Task::where('user_id',$groupMember[$i][$j]->user_id)->where('status',2)->count();
                if($tasks_num){
                    $div = $achievement_tasks_num / $tasks_num;
                    $achievment_rate = (round($div,2)) * 100;
                }else{
                    $achievment_rate = 0;
                }

                $grouptaskData[] = $achievment_rate;
            }

            //グループのタスク平均計算
            if($groupMemberCount[$i] == 0){
                $taskData = 0;
            } else {
                $taskData = round((array_sum($grouptaskData))/$groupMemberCount[$i]);
            }

            //各グループのタスク平均の配列
            $groupTodayData[$group[$i]->name] = $taskData;
            $grouptaskData = [];
        }

        //各グループのタスク平均の配列のソート、上位5つの抽出
        arsort($groupTodayData);
        $groupTodayData = array_slice($groupTodayData,0,5);

        return $groupTodayData;
    }

    //ランキング（グループ一週間）
    public function groupOneWeekTaskRanking()
    {
        $group = Group::all();
        $groupCount = Group::all()->count();

        //一週間分の日付の配列
        for($i = 0; $i > -7; $i--){
            $date[] = date("Y-m-d",strtotime("$i day"));
        }

        //各グループの人数の配列
        for($i = 0; $i < $groupCount; $i++){
            $groupMemberCount[] =  GroupMember::where('group_id',$i+1)->count();
        }

        //各グループのメンバーの配列
        for($i = 0; $i < $groupCount; $i++){
            $groupMember[] =  GroupMember::where('group_id',$i+1)->get();
        }

        for($i = 0; $i < $groupCount; $i++) {
            $count = $groupMemberCount[$i];
            for ($j = 0; $j < $count; $j++) {
                for ($k = 0; $k < 7; $k++) {
                    $tasks_num = Task::where('user_id',$groupMember[$i][$j]->user_id)->where('date',$date[$k])->count();
                    $achievement_tasks_num = Task::where('user_id',$groupMember[$i][$j]->user_id)->where('status',2)->count();
                    if($tasks_num){
                        $div = $achievement_tasks_num / $tasks_num;
                    $achievment_rate = (round($div,2)) * 100;
                    }else{
                        $achievment_rate = 0;
                    }

                    $grouptaskData[] = $achievment_rate;
                }

                $taskData = round((array_sum($grouptaskData))/7);
                $groupOneWeektaskData[] = $taskData;
                $grouptaskData = [];
            }

            //グループのタスク平均計算
            if($groupMemberCount[$i] == 0){
                $taskData = 0;
            } else {
                $taskData = round((array_sum($groupOneWeektaskData))/$groupMemberCount[$i]);
            }

            //各グループのタスク平均の配列
            $groupOneWeekData[$group[$i]->name] = $taskData;
            $groupOneWeektaskData = [];
        }

        //各グループのタスク平均の配列のソート、上位5つの抽出
        arsort($groupOneWeekData);
        $groupOneWeekData = array_slice($groupOneWeekData,0,5);

        return $groupOneWeekData;
    }

}
