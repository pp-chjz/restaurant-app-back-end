<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodTable extends Model
{
    use HasFactory;

    // set default attr value
    protected $attributes = [
        'tablenum_status' => 3,
        'checkbill_status' => 2,
        'have_order' => 0,
        'order_id' => 0
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function bill()
    {
        return $this->hasMany(Bill::class);
    }
}
