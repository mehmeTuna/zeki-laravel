<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'id';
    protected $hidden = []; //bu kolonlarin gormez olmasini saglar
    protected $fillable = ['*']; // tum kolonlarin degistirilebilir olmasini saglar

    public function menuItems()
    {
        return $this->hasMany('App\Products', 'categoryId', 'id')->where('products.live', 1)->orderBy('queue', 'ASC');
    }

    public function getImgAttribute($value)
    {
        return "/public/{$value}";
    }

}
