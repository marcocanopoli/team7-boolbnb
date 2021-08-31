<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseType extends Model

{
    protected $fillable = [
        'house_id',
        'name'
    ];

    public function housetype() {
        return $this->belongsTo('App\HouseType');
    }
}
