<?php

namespace App;

use Carbon\Carbon;
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

    public function dayOrderCount()
    {
        $date = Carbon::now()->startOfDay()->timestamp;
        return $this->hasMany('App\KuryeTakip', 'kurye_id', 'id')->where('kurye_takip.start_date', '>=', $date);
    }

    public function monthOrderCount()
    {
        $date = Carbon::now()->startOfMonth()->timestamp;
        return $this->hasMany('App\KuryeTakip', 'kurye_id', 'id')->where('kurye_takip.start_date', '>=', $date);
    }

    public function yearOrderCount()
    {
        $date = Carbon::now()->startOfYear()->timestamp;
        return $this->hasMany('App\KuryeTakip', 'kurye_id', 'id')->where('kurye_takip.start_date', '>=', $date);
    }
}
