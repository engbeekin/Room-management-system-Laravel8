<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded=['id'];



    public function Customer(){
        return $this->belongsTo(Customers::class);
    }
    public function Room(){
        return $this->belongsTo(Rooms::class);
    }
     public function getStayingAttribute()
    {
        # code...
        return $this->checkin_date->diffInDays($this->checkout_date);
    }
}
