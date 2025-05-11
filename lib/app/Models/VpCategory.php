<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VpCategory extends Model
{
    use HasFactory;

    protected $primaryKey = 'cate_id';
    protected $guarded = [];

    public function news()
    {
        return $this->hasMany(VpNews::class, 'news_cate', 'cate_id');
    }
}
