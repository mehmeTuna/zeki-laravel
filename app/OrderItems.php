<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'order_id';
    protected $hidden = ['user_id', 'address_id', 'adress', 'features', 'ip']; //bu kolonlarin gormez olmasini saglar
    protected $guarded = []; // tum kolonlarin degistirilebilir olmasini saglar
    public $timestamps = false ;

    protected $casts = [
        'orders' => 'array'
    ];


}
