<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class TaskService extends Facade
{
    protected static function getFacadeAccessor() {
        return 'TaskService';
    }
}