<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $hidden = []; //bu kolonlarin gormez olmasini saglar
    protected $guarded = []; // tum kolonlarin degistirilebilir olmasini saglar
    public $timestamps = false ;

    protected $casts = [
        'other_img' => 'array'
    ];

    protected $attributes = [
        'queue' => 0,
        'numberOfProduct' => 100,
        'unlimited' => 1,
        'live' => 1,
        'stores' => 'Adana'
    ];


    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'categoryId');
    }

    public function option()
    {
        return $this->hasOne('App\Feature', 'id', 'features');
    }

    public function getImgAttribute($value)
    {
        return "/public/{$value}";
    }

    public function setOther_ImgAttribute($value)
    {
        $this->attributes['other_img'] = json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function dayOrderCount()
    {
        $date = Carbon::now()->startOfDay()->timestamp;
        return $this->hasMany('App\OrderItems', 'product_id', 'id')->where('order_items.m_date', '>=', $date);
    }

    public function weekOrderCount()
    {
        $date = Carbon::now()->startOfWeek()->timestamp;
        return $this->hasMany('App\OrderItems', 'product_id', 'id')->where('order_items.m_date', '>=', $date);
    }

    public function monthOrderCount()
    {
        $date = Carbon::now()->startOfMonth()->timestamp;
        return $this->hasMany('App\OrderItems', 'product_id', 'id')->where('order_items.m_date', '>=', $date);
    }

    public function yearOrderCount()
    {
        $date = Carbon::now()->startOfYear()->timestamp;
        return $this->hasMany('App\OrderItems', 'product_id', 'id')->where('order_items.m_date', '>=', $date);
    }
}
