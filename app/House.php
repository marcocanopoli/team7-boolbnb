<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'rooms',
        'beds',
        'bathrooms',
        'square_meters',
        'city',
        'address',
        'zip_code',
        'latitude',
        'longitude',
        'description',
        'price',
        'guests',
        'visible'
    ];

    // protected $with = [];

    //one to many
    public function user() {
        return $this->belongsTo('App\User');
    }
}
