<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kurye extends Model
{
    protected $table = 'kurye';
    protected $primaryKey = 'id';
    protected $hidden = ['password']; //bu kolonlarin gormez olmasini saglar
    protected $guarded = [];
    protected $casts =[
        'date' => 'datetime:Y-m-d G:i',
    ];

    public $timestamps = false;

    public function orderCount()
    {
        return $this->hasMany('App\KuryeTakip', 'kurye_id', 'id')->count();
    }


}
