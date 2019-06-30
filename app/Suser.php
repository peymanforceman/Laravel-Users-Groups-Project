<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suser extends Model
{
    public function groups()
    {
        return $this->belongsToMany('App\Sgroup', 'susers_groups_relationship', 'suser_id', 'sgroup_id');
    }
}
