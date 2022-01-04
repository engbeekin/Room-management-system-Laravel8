<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;
protected $guarded=['id'];

    public function booking(){
        return $this->hasMany(Booking::class,'room_id','id');
        // Carbon::()
    }
}
