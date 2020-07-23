<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $table = 'locations';
    protected $primaryKey = 'id';
    protected $hidden = ['created_at', 'updated_at']; //bu kolonlarin gormez olmasini saglar
    protected $guarded = [];
    public $timestamps = false ;
}
