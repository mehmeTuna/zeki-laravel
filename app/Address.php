<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $primaryKey = 'id';
    protected $hidden = ['active', 'location_id', 'created_at', 'updated_at']; //bu kolonlarin gorunur olmasini saglar
    protected $guarded = ['id']; // tum kolonlarin degistirilebilir olmasini saglar

    public function location()
    {
        return $this->hasOne('App\Location', 'id', 'location_id');
    }
}