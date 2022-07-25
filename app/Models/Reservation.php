<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'guest_name', 'checkin','checkout','room_id', 'status'
    ];
    public function room(){
        return $this->belongsTo('App\Models\Room');
    }
}
