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
    protected $fillable = ['donated_to', 'amount', 'payee_user_id', 'payment_details', 'payment_receipt', 'payer_user_id'];


}
