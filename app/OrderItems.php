<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'order_id';
    protected $hidden = ['ip']; //bu kolonlarin gormez olmasini saglar
    protected $fillable = ['*']; // tum kolonlarin degistirilebilir olmasini saglar

    protected $casts = [
        'orders' => 'array'
    ];

    public function getOrdersAttribute($value)
    {
        return json_decode($value);
    }

}
