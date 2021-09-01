<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $fillable = [
        'user_id',
        'house_type_id',
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
    public function housetype() {
        return $this->belongsTo('App\HouseType');
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

    //many to many
    public function services() {
		return $this->belongsToMany('App\Service');
	}
    public function promotions() {
		return $this->belongsToMany('App\Promotion');
	}

}
