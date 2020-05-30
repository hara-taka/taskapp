<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\TaskService;

class TaskServiceTest extends TestCase
{
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

}
