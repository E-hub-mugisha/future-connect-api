<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    //
    protected $table = 'stories';
    protected $fillable = [
        'talent_id',
        'title',
        'content',
        'media',
        'thumbnail',
        'slug',
        'category_id',
        'tags',
        'status'
    ];
    public function talent()
    {
        return $this->belongsTo(Talent::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
