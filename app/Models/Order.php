<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_code',
        'user_id',
        'total_amount',
        'order_status',
        'additional_note'
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderdetails(){
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

}
