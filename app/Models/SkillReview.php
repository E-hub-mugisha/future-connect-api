<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillReview extends Model
{
    protected $fillable = ['skill_id', 'name', 'email', 'rating', 'message'];

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
