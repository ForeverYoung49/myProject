<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pack_genre extends Model
{
    protected $table = 'pack_genre';
    protected $fillable = ['genre_id','manga_id'];
}
