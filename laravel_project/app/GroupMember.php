<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    public function groups()
    {
        return $this->belongsTo('App\Group');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}
