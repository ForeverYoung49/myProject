<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments_news extends Model
{
    protected $table = 'comments_news';
    protected $fillable = ['txt','user_id','news_id','status','updated_at','created_at'];
}
