<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseType extends Model

{
    protected $fillable = ['name'];

    protected $with = ['houses'];

    public function houses() {
        return $this->hasMany('App\House', 'id');
    }
}
