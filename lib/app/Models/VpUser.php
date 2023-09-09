<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VpUser extends Model
{
    protected $table = 'vp_users';

    protected $fillable = [
        'email',
        'password',
    ];

    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
