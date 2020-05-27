<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\UtilService;

class UtilServiceTest extends TestCase
{
    //一週間分の日付の配列の取得のテスト
    public function testOneWeekDate()
    {
        $actual_date = UtilService::oneWeekDate();

        for($i = 0; $i > -7; $i--){
            $expected_date[] = date("Y-m-d",strtotime("$i day"));
        }

        $this->assertEquals($actual_date, $expected_date);
    }
}
