<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryComment extends Model
{
    protected $fillable = [
        'story_id',
        'name',
        'email',
        'comment',
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}
