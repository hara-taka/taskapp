<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function group_members()
    {
        return $this->hasMany('App\GroupMember');
    }
}
