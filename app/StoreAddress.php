<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreAddress extends Model
{
    protected $table = 'store_address';
    protected $primaryKey = 'id';
    protected $hidden = ['store_id', 'address_id', 'active']; //bu kolonlarin gormez olmasini saglar
    protected $guarded = ['id']; // tum kolonlarin degistirilebilir olmasini saglar
    public $timestamps = false ;

    public function address()
    {
        return $this->hasOne('App\Address', 'id', 'address_id');
    }

    public function orders()
    {
        return $this->hasMany('App\OrderItems', 'address_id', 'address_id')->with(['kurye', 'user', 'address'])->whereIn('order_items.m_status', [0, 1, 2, 3, 4, 5])->orderBy('order_items.m_date', 'DESC')->get();
    }
}
