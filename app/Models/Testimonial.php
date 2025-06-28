<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    //
    protected $fillable = ['talent_id', 'title', 'content', 'rating'];

    public function talent()
    {
        return $this->belongsTo(Talent::class);
    }
}
