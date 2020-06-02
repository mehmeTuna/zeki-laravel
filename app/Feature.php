<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table = 'feature';
    protected $primaryKey = 'id';
    protected $hidden = []; //bu kolonlarin gormez olmasini saglar
    protected $guarded = []; // tum kolonlarin degistirilebilir olmasini saglar

    protected $casts = [
        'content' => 'array'
    ];

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = json_encode($value);
    }
}
