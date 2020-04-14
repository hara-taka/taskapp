<?php

namespace App\Services;

use Carbon\Carbon;

class CalendarService {
    //カレンダー表示日を取得
    public function calendarShowDates($year, $month)
    {
        $dateStr = sprintf('%04d-%02d-01', $year, $month);
        $date = new Carbon($dateStr);

        $date->subDay($date->dayOfWeek);

        $count = 31 + $date->dayOfWeek;
        $count = ceil($count / 7) * 7;
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

        $date->subDay($date->dayOfWeek);

        $count = 31 + $date->dayOfWeek;
        $count = ceil($count / 7) * 7;

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