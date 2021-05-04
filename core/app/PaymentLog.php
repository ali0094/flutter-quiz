<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    protected $table = 'payment_logs';

    protected $fillable = ['amount','member_id','custom','status'];
}
