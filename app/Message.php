<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'house_id',
        'guest_name',
        'guest_email',
        'content'
    ];
    
    public function house() {
        return $this->belongsTo('App\House');
    }
}
