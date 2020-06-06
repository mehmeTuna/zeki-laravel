<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rezervasyon extends Model
{
    protected $table = 'rezervasyon';
    protected $primaryKey = 'id';
    protected $hidden = ['ip', 'm_status']; //bu kolonlarin gormez olmasini saglar
    protected $guarded = []; // tum kolonlarin degistirilebilir olmasini saglar
    public $timestamps = false ;
    protected $attributes = [
        'm_status' => 0
    ];


}
