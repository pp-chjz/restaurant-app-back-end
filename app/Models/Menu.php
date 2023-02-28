<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // set default attr value
    protected $attributes = [
        'catagories' => 1,
        'menu_id' => "false",
        'menu_status' => 1,
        // 'QTY' => 1,
        'sort_menu' => 1,
        'size' => 'l',
        // 'ingredient_id' => 0,
        // 'order_id' => 0 ,
    ];

    // public function recipes()
    // {
    //     return $this->hasMany(Recipe::class);
    // }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class)->withPivot('QTY', 'price' , 'status', 'food_status', 'comment', 'order_time', 'complete_at')
        ->withTimestamps();
    }
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
    public function Orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
