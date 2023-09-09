<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VpProduct extends Model
{
    use HasFactory;
    protected $primaryKey = 'prod_id';
    protected $guarded = [];
}
