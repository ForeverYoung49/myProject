<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating_manga extends Model
{
    protected $table = 'rating_manga';
    protected $fillable = ['user_id','manga_id','mark'];
}
