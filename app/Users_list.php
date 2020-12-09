<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_list extends Model
{
    protected $table = 'users_list';
    protected $fillable = ['user_id','manga_id','status'];
}
