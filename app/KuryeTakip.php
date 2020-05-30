<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KuryeTakip extends Model
{
    protected $table = 'kurye_takip';
    protected $primaryKey = 'id';
    protected $visible = ['id', 'order_id', 'kurye_id', 'start_date', 'finish_date']; //bu kolonlarin gormez olmasini saglar
    protected $fillable = ['*']; // tum kolonlarin degistirilebilir olmasini saglar

}
