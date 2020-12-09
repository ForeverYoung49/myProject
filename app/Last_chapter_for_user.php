<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Last_chapter_for_user extends Model
{
    protected $table = 'LastChapterForUser';
    protected $fillable = ['chapter_id','user_id','manga_id','updated_at','created_at'];
}
