<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapster_pages extends Model
{
    protected $table = 'chapster_pages';
    protected $fillable = ['page','chapster_id','updated_at','created_at'];
}
