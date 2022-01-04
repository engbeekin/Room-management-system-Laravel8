<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $guarded=['id'];

    public function booking(){
        return $this->hasMany(Booking::class,'customer_id','id');
    }

    // public function setCreatedAtAttribute($value){
    //     return $this->attribute['created_ate']=Carbon::createFromDate('m/d/y',$value)->format('d/m/y');
    // }

    protected  $casts = [
        'created_at' => 'datetime:Y-m-d'
    ];


}
