<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'donations';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['donated_to', 'amount', 'payee_user_id', 'payment_details', 'payment_receipt', 'payer_user_id', 'user_level_id'];

    public function sender()
    {
       return $this->belongsTo('App\User', "payer_user_id", "id");
    }

    public function receiver()
    {
        return $this->belongsTo('App\User', "payee_user_id", "id");
    }

    public function level()
    {
        return $this->belongsTo('App\Level');
    }
}
