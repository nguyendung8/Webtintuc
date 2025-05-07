<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VpNews extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'news_id';
    protected $table = 'vp_news';
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(VpCategory::class, 'news_cate', 'cate_id');
    }
}