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

    const WAITING = 0;
    const SUCCESS = 1;
    const CANCEL = 2;
    const KURYEVERILDI = 5;

    protected $casts = [
        'orders' => 'array'
    ];

    public function kurye()
    {
        return $this->hasOneThrough('App\Kurye', 'App\KuryeTakip', 'order_id', 'id', 'order_id', 'kurye_id');
    }

    public function user()
    {
        return $this->hasOne('App\Users', 'id', 'user_id');
    }

    public function address()
    {
        return $this->hasOne('App\UserAddress', 'address_id', 'adress')->where('user_address.user_id', session('userId'));
    }
}
