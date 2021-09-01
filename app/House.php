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

    protected $with = [ 'photos', 'services'];

    //one to many->side many
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    //one to many->side one
    public function photos() {
        return $this->hasMany('App\Photo');
    }
    public function messages() {
        return $this->hasMany('App\Message');
    }
    public function views() {
        return $this->hasMany('App\View');
    }

    //one to one
    public function houseType() {
        return $this->hasOne('App\HouseType');
    }

    //many to many
    public function services() {
		return $this->belongsToMany('App\Service');
	}
    public function promotions() {
		return $this->belongsToMany('App\Promotion');
	}

}
