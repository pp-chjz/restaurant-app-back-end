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
    ];

    public function Menus()
    {
        return $this->belongsToMany(Menu::class);
    }
    public function TableNumbers()
    {
        return $this->belongsToMany(Tablenumber::class);
    }
}
