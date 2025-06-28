<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talent extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'talents';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'skill',
        'story',
        'rating',
        'status',
        'featured',
        'description',
        'image',
        'address',
        'phone',
        'email',
        'language',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function stories()
    {
        return $this->hasMany(Story::class);
    }
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
