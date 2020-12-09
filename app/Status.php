<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'status_manga';
    public $timestamps = false;
    protected $fillable = ['name'];
}
