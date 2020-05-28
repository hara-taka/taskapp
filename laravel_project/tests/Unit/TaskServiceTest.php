<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\TaskService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Task;
use App\User;

class TaskServiceTest extends TestCase
{
    use RefreshDatabase;

    //カレンダー表示用のタスク達成率の配列のテスト
    public function testCalendarTaskAchievement()
    {
        $user = factory(User::class)->make([
            'id' => '1'
        ]);

        $user->save();

        $task = factory(Task::class)->make([
            'user_id' => '1',
            'status' => '2',
            'date' => '2019-01-01'
        ]);

        $task->save();

        $actual_data = TaskService::calendarShowDates(35, '2019-12-29',1);

        for($i = 0; $i < 35; $i++){
            if($i == 3){
                $expected_data[] = 100;
            }
            $expected_data[] = 0;
        }

        $this->assertEquals($actual_data, $expected_data);
    }

    //達成率の計算処理のテスト
    public function testTaskAchievementCalculation(){
        $user = factory(User::class)->make([
            'id' => '1'
        ]);

        $user->save();

        $task = factory(Task::class)->make([
            'user_id' => '1',
            'status' => '2',
            'date' => '2019-01-01'
        ]);

        $task->save();

        $actual_data = TaskService::taskAchievementCalculation(1, '2019-01-01');

        $expected_data = 100;

        $this->assertEquals($actual_data, $expected_data);
    }

    //一週間分のタスクの達成率の日にちのテスト
    public function testOneWeekTaskAchievementDate(){
        $actual_data = TaskService::oneWeekTaskAchievementDate();

        for ($i = 0; $i < 7; $i++) {
            $date = date("Y-m-d", strtotime('-'.$i .'day'));
            $expected_data[] = $date;
        }

        $expected_data = array_reverse($expected_data);

        $this->assertEquals($actual_data, $expected_data);
    }

    //一週間分のタスクの達成率
    public function testOneWeekTaskAchievement(){
        $user = factory(User::class)->make([
            'id' => '1'
        ]);

        $user->save();

        $date = date('Y-m-d');

        $task = factory(Task::class)->make([
            'user_id' => '1',
            'status' => '2',
            'date' => $date
        ]);

        $task->save();

        $oneWeekdate = TaskService::oneWeekTaskAchievementDate();

        $actual_data = TaskService::oneWeekTaskAchievement(１,$oneWeekdate);

        $expected_data = [100,0,0,0,0,0,0];

        $this->assertEquals($actual_data, $expected_data);
    }

}
