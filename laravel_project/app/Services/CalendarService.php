<?php

namespace App\Services;

use Carbon\Carbon;

class CalendarService {
    //カレンダー表示日を取得
    public function calendarShowDates($year, $month)
    {
        $dateStr = sprintf('%04d-%02d-01', $year, $month);
        $date = new Carbon($dateStr);

        //カレンダーに表示させる先月分の日数
        $lastMonthDateCount = $date->dayOfWeek;

        //当月の日数
        $thisMonthDateCount = $date->daysInMonth;

        //カレンダーに表示させる翌月分の日数
        $day = $thisMonthDateCount;
        $nextMonthDateStr = sprintf('%04d-%02d-%01d', $year, $month,$day);
        $nextMonthDate = new Carbon($nextMonthDateStr);
        $nextMonthDateCount = $nextMonthDate->dayOfWeek;
        $nextMonthDateCount = 6 - $nextMonthDateCount;

        //カレンダーに表示させる日付の数
        $count = $lastMonthDateCount + $thisMonthDateCount + $nextMonthDateCount;

        //カレンダーに表示させる最初の日付
        $date->subDay($date->dayOfWeek);

        $dates = [];

        for ($i = 0; $i < $count; $i++, $date->addDay()) {
            $dates[] = $date->copy();
        }
        return $dates;
    }

    //カレンダー表示用タスク達成率に必要な情報を取得
    //$data:カレンダーに表示させる最初の日
    //$count:カレンダーに表示させる日数
    public function calendarTaskAchievementDates($year, $month)
    {
        $dateStr = sprintf('%04d-%02d-01', $year, $month);
        $date = new Carbon($dateStr);

        //カレンダーに表示させる先月分の日数
        $lastMonthDateCount = $date->dayOfWeek;

        //当月の日数
        $thisMonthDateCount = $date->daysInMonth;

        //カレンダーに表示させる翌月分の日数
        $day = $thisMonthDateCount;
        $nextMonthDateStr = sprintf('%04d-%02d-%01d', $year, $month,$day);
        $nextMonthDate = new Carbon($nextMonthDateStr);
        $nextMonthDateCount = $nextMonthDate->dayOfWeek;
        $nextMonthDateCount = 6 - $nextMonthDateCount;

        //カレンダーに表示させる日付の数
        $count = $lastMonthDateCount + $thisMonthDateCount + $nextMonthDateCount;

        //カレンダーに表示させる最初の日付
        $date->subDay($date->dayOfWeek);

        return array($date, $count);
    }

    public function calendarDate($dt,$change_month)
    {
        //カレンダー表示用の年、月の取得
        //カレンダー前月、翌月表示処理
        if($dt == 'this_month'){
            $dt = Carbon::now();
        } elseif($change_month == 'prev') {
            $dt = new Carbon($dt);
            $dt = $dt->subMonthsNoOverflow();
        } elseif($change_month == 'next') {
            $dt = new Carbon($dt);
            $dt = $dt->addMonthsNoOverflow();
        }
        return $dt;
    }
}