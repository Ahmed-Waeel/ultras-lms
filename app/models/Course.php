<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table="courses";

    protected $fillable = [
        'title', 'cover', 'description', 'instructor', 'duration', 'price', 'category',
    ];

    public function category(){
        return $this->belongsTo('App\Models\Category','category','id');
    }

    public function lessons(){
        return $this->hasMany('App\Models\Lesson','course','id');
    }
}
