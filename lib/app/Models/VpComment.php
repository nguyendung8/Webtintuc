<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VpComment extends Model
{
    use HasFactory;

    protected $primaryKey = 'com_id';

    public function news()
    {
        return $this->belongsTo(VpNews::class, 'com_new', 'news_id');
    }

}
