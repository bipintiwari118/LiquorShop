<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

     protected $fillable = ['name', 'email','delivery', 'phone', 'status', 'address', 'total'];


    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }
}
