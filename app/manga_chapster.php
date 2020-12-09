<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class manga_chapster extends Model
{
    protected $table = 'manga_chapster';
    protected $fillable = ['name','number','tome','manga_id','updated_at','created_at'];
}
