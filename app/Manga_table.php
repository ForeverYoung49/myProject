<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manga_table extends Model
{
    protected $table = 'manga_table';
    public $timestamps = false;
    protected $fillable = ['name','desctiption','rating','img','author_id','status_id','updated_at','created_at'];
}
