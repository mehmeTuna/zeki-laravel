<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    protected $table = 'cupon';
    protected $primaryKey = 'id';
    protected $hidden = ['id']; //bu kolonlarin gormez olmasini saglar
    protected $guarded = []; // tum kolonlarin degistirilebilir olmasini saglar

}
