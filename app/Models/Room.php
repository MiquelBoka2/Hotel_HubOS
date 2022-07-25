<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'capacity', 'floor','status','hotel_id'
    ];
    public function hotel(){
        return $this->belongsTo('App\Models\Hotel');
    }
}
