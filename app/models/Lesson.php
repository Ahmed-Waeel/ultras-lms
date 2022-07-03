<?php

namespace App\Models;


use App\Http\Requests\LessonRequest;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table="lessons";

    protected $fillable= [
        'title', 'description', 'video', 'course',
    ];

    public function course(){
        return $this->belongsTo('App\Models\Course','course','id');
    }
}
