<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    // set default attr value
    protected $attributes = [
        'cancel_status' => 1,
        'order_status' => 1,
    ];
}
