<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
   protected $guarded = ['id'];
   protected $table = 'stages';
}
