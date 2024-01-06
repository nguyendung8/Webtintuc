<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VpProduct;

class VpFavouriteProduct extends Model
{
    use HasFactory;

    protected $table = 'vp_favourite_products';
    protected $guarded = [];
}
