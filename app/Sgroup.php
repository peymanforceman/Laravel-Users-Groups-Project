<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sgroup extends Model
{

    public function users()
    {
        return $this->belongsToMany('App\Suser', 'susers_groups_relationship', 'sgroup_id', 'suser_id');
    }

}
