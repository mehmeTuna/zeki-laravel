<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $primaryKey = 'id';
    protected $hidden = ['active', 'created_at', 'updated_at']; //bu kolonlarin gorunur olmasini saglar
    protected $guarded = ['id']; // tum kolonlarin degistirilebilir olmasini saglar
}
