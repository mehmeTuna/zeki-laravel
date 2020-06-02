<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $hidden = ['password', 'ip', 'verification_code']; //bu kolonlarin gormez olmasini saglar
    protected $guarded = []; // tum kolonlarin degistirilebilir olmasini saglar
    public $timestamps = false ;

    protected $casts = [
        'adress' => 'array',
        'adress_2' => 'array',
        'adress_3' => 'array'
    ];

    protected $attributes = [
        'email_verified' => 1,
        'first_order' => 0,
        'verification_code' => ''
    ];


  
    public function orderCount()
    {
        return $this->hasMany('App\OrderItems', 'user_id', 'id')->where('order_items.m_status', 5)->count();
    }

    public function setAdressAttribute($value)
    {
        $this->attributes['adress'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function address()
    {
        return $this->hasMany('App\UserAddress', 'user_id', 'id');
    }

}
