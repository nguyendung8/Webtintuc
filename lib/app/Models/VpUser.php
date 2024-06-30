<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VpProduct;

class VpUser extends Model
{
    use HasFactory;

    protected $table = 'vp_users';

    protected $fillable = [
        'email',
        'password',
    ];

    public function favoriteProducts()
    {
        return $this->belongsToMany(VpProduct::class, 'vp_favourite_products', 'user_id', 'favou_product');
    }
}
