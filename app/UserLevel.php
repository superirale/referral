<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLevel extends Model
{
    protected $table = "user_levels";

    protected $guarded = ['id'];

    public function level()
    {
    	return $this->belongsTo('App\Level');
    }
}
