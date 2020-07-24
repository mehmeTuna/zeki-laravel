<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $primaryKey = 'id';
    protected $hidden = ['created_at', 'updated_at', 'active']; //bu kolonlarin gormez olmasini saglar
    protected $guarded = ['id'];
}
