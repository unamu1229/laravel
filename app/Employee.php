<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function paymentType()
    {
        return $this->hasOne(PaymentType::class, 'id', 'payment_type_id');
    }
}
