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
        'menu_id' => 0,
        'tablenumber_id' => 0,
        'table_number' => 0,
        'pay_status' => 1,

    ];

    public function Menus()
    {
        return $this->belongsToMany(Menu::class)->withPivot('QTY', 'price' , 'status', 'food_status', 'comment', 'order_time', 'complete_at')
        ->withTimestamps();
    }
    public function TableNumbers()
    {
        return $this->belongsToMany(Tablenumber::class);
    }
}
