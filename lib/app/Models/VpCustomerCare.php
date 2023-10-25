<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VpCustomerCare extends Model
{
    use HasFactory;

    protected $table = 'vp_customer_cares';

    protected $fillable = [
        'name',
        'phone_number',
        'question',
    ];
}
