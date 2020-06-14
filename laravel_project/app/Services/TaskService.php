<?php

namespace App\Services;

use App\Task;
use App\User;
use App\GroupMember;
use App\Group;
use Carbon\Carbon;
use UtilService;

class TaskService {
    //カレンダー表示用のタスク達成率の配列
    public function calendarTaskAchievement($count,$date,$user_id)
    {
        //本日以降のカレンダー表示タスク達成率を「-」表示するため$dateと比較するための変数
        $comparision_date = date('Y-m-d', strtotime('+1 day'));

        for ($i = 0; $i < $count; $i++, $date->addDay()) {
            $tasks_num = Task::where('user_id',$user_id)->where('date',$date)->count();
            $achievement_tasks_num = Task::where('user_id',$user_id)->where('date',$date)->where('status',2)->count();
            if($tasks_num){
                $div = $achievement_tasks_num / $tasks_num;
                $achievment_rate = (round($div,2)) * 100;
            }elseif($date >= $comparision_date){
                $achievment_rate = '-';
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
        $achievement_tasks_num = Task::where('user_id',$user_id)->where('date',$today)->where('status',2)->count();
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
            $achievement_tasks_num = Task::where('user_id',$user_id)->where('date',$oneWeekTaskDate[$i])->where('status',2)->count();
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
            $achievement_tasks_num = Task::where('user_id',$user[$i]->id)->where('date',$date)->where('status',2)->count();
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

        //ランキングの順位配列
        $personalTodayRank = $this->rank($personalTodayData);

        //ランキングのユーザー名の配列
        $personalTodayName = array_keys($personalTodayData);

        //ランキングのタスクの達成率の配列
        $personalTodayTask = array_values($personalTodayData);

        return array($personalTodayName, $personalTodayTask, $personalTodayRank);
    }

    //ランキング（個人一週間）
    public function personalOneWeekTaskRanking()
    {
        $user = User::all();
        $count = $user->count();

        //一週間分の日付の配列
        $date = UtilService::oneWeekDate();

        //ユーザーごと一週間の繰り返し処理
        for($j = 0; $j < $count; $j++) {
            for ($i = 0; $i < 7; $i++) {
                $tasks_num = Task::where('user_id',$user[$j]->id)->where('date',$date[$i])->count();
                $achievement_tasks_num = Task::where('user_id',$user[$j]->id)->where('date',$date[$i])->where('status',2)->count();
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

        //ランキングの順位配列
        $personalOneWeekRank = $this->rank($personalOneWeekData);

        //ランキングのユーザー名の配列
        $personalOneWeekName = array_keys($personalOneWeekData);

        //ランキングのタスク達成率の配列
        $personalOneWeekTask = array_values($personalOneWeekData);

        return array($personalOneWeekName, $personalOneWeekTask, $personalOneWeekRank);
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
                $achievement_tasks_num = Task::where('user_id',$groupMember[$i][$j]->user_id)->where('date',$date)->where('status',2)->count();
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

        //ランキングの順位配列
        $groupTodayRank = $this->rank($groupTodayData);

        //ランキングのグループ名の配列
        $groupTodayName = array_keys($groupTodayData);

        //ランキングのタスク達成率の配列
        $groupTodayTask = array_values($groupTodayData);

        return array($groupTodayName, $groupTodayTask, $groupTodayRank);
    }

    //ランキング（グループ一週間）
    public function groupOneWeekTaskRanking()
    {
        $group = Group::all();
        $groupCount = Group::all()->count();

        //一週間分の日付の配列
        $date = UtilService::oneWeekDate();

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
                    $achievement_tasks_num = Task::where('user_id',$groupMember[$i][$j]->user_id)->where('date',$date[$k])->where('status',2)->count();
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

        //ランキングの順位配列
        $groupOneWeekRank = $this->rank($groupOneWeekData);

        //ランキングのグループ名の配列
        $groupOneWeekName = array_keys($groupOneWeekData);

        //ランキングのタスク達成率の配列
        $groupOneWeekTask = array_values($groupOneWeekData);

        return array($groupOneWeekName, $groupOneWeekTask, $groupOneWeekRank);
    }

    //ランキングの順位取得
    public function rank($rankingArray)
    {
        $rankingArrayValues = array_values($rankingArray);
        $count = count($rankingArrayValues);

        $rank = 1;
        $rankArray[] = $rank;

        for($i = 0; $i < $count-1; $i++){
            if($rankingArrayValues[$i] == $rankingArrayValues[$i+1]){
                $rankArray[] = $rank;
            } else {
                $rank = $rank+1;
                $rankArray[] = $rank;
            }
        }

        return $rankArray;
    }

}
