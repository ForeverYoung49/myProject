<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments_manga extends Model
{
    protected $table = 'comments_manga';
    protected $fillable = ['txt','user_id','manga_id','status','updated_at','created_at'];
}
