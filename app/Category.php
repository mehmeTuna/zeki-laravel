<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $hidden = []; //bu kolonlarin gormez olmasini saglar
    protected $guarded = []; // tum kolonlarin degistirilebilir olmasini saglar
    public $timestamps = false ;
    protected $attributes = [
        'queue' => 0
    ];

    public function menuItems()
    {
        return $this->hasMany('App\Products', 'categoryId', 'id')->where('products.live', 1)->orderBy('queue', 'ASC');
    }

    public function getImgAttribute($value)
    {
        return "/public/{$value}";
    }

}
