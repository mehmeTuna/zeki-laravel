<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KuryeTakip extends Model
{
    protected $table = 'kurye_takip';
    protected $primaryKey = 'id';
    protected $fillable = [];
    protected $guarded = [];
    public $timestamps = false ;

}
