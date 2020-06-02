<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'store';
    protected $primaryKey = 'id';
    protected $hidden = ['active']; //bu kolonlarin gormez olmasini saglar
    protected $guarded = ['id']; // tum kolonlarin degistirilebilir olmasini saglar
    public $timestamps = false ;
   
}
