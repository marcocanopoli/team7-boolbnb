<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = [
        'house_id',
        'ip_address'        
    ];

    public function house() {
        return $this->belongsTo('App\House');
    }
}
