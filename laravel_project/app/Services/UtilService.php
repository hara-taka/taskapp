<?php

namespace App\Services;

class UtilService {
  public function oneWeekDate() {
    for($i = 0; $i > -7; $i--){
      $date[] = date("Y-m-d",strtotime("$i day"));
    }

    return $date;
  }
}