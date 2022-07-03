<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="categories";

    protected $fillable = [
        'title', 'cover',
    ];

    public function courses(){
        return $this->hasMany('App\Models\Course','category','id');
    }
}
