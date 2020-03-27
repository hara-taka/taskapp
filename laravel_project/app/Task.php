<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function users()
    {
        return $this->belongsTo('App\User');
    }

    const STATUS = [
        1 => [ 'status_name' => '未完了' ],
        2 => [ 'status_name' => '完了' ],
    ];

    public function getTaskStatusAttribute() {

        $status = $this->attributes['status'];

        return self::STATUS[$status]['status_name'];
    }
}
