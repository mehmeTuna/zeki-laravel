<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $hidden = []; //bu kolonlarin gormez olmasini saglar
    protected $fillable = ['*']; // tum kolonlarin degistirilebilir olmasini saglar

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
}
