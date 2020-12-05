<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_address';
    protected $guarded = [];
    protected $hidden = ['active', 'user_id', 'address_id'];
    public $timestamps = false ;

    public function address()
    {
        return $this->hasOne('App\Address', 'id', 'address_id');
    }
}
