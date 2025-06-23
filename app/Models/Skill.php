<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'talent_id',
        'category_id',
        'tags',
        'status',
        'level'
    ];

    public function talent()
    {
        return $this->belongsTo(Talent::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function reviews()
{
    return $this->hasMany(SkillReview::class);
}

}
