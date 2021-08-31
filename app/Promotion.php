<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration'
    ];  

    public function houses() {
		return $this->belongsToMany('App\House');
	}

}
