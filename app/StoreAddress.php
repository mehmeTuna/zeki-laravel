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
}
