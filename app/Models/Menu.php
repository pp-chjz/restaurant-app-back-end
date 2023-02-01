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
        'menu_status' => 1,
        'QTY' => 1,
        'sort_menu' => 1,
        'size' => 'l',
    ];

    // public function recipes()
    // {
    //     return $this->hasMany(Recipe::class);
    // }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}