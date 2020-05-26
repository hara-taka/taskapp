<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\CalendarService;
use Carbon\Carbon;

class CalendarServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /*public function testExample()
    {
        $this->assertTrue(true);
    }*/

    //カレンダー表示用の年、月の取得のテスト
    public function testCalendarDate()
    {
        $dt = 'this_month';
        $change_month='this_month';
        $expected_date = CalendarService::calendarDate($dt,$change_month);

        $expected_date = substr($expected_date, 0, 10);

        $date = Carbon::now();

        $actual_date = substr($date, 0, 10);

        $this->assertEquals($actual_date, $expected_date);
    }

    //カレンダー表示日を取得のテスト
    public function testCalendarShowDates()
    {
        $expected_date = CalendarService::calendarShowDates(2020, 01);

        $actual_date = 35;

        $this->assertCount($actual_date, $expected_date);
    }

    //カレンダーに表示させる最初の日、表示させる日数のテスト
    public function testCalendarTaskAchievementDates()
    {
        list($actual_date, $actual_count) = CalendarService::calendarTaskAchievementDates(2020, 01);

        $actual_date = substr($actual_date, 0, 10);

        $expected_date = '2019-12-29';
        $expected_count = 35;

        $this->assertEquals($actual_date, $expected_date);

        $this->assertEquals($actual_count, $expected_count);
    }
}
