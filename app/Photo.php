<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'house_id',
        'path'
    ];

    public function house() {
        return $this->belongsTo('App\House');
    }
}
