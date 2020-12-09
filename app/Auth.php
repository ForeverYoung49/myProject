<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auth extends Model
{
    protected $table = 'author_manga';
    public $timestamps = false;
    protected $fillable = ['name'];
}
