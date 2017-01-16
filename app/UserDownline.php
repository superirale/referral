<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDownline extends Model
{
    protected $table = 'user_downlines';

    protected $guarded = ['id'];

    public function users()
    {
    	return $this->hasMany('App\User');
    }

   public function downline_user()
   {
   		return $this->hasOne('App\User', 'id', 'downline_user_id');
   }

}
