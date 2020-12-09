<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bans extends Model
{
    protected $table = 'bans';
    protected $fillable = ['id','user_id','reason','application','updated_at','created_at'];
}
