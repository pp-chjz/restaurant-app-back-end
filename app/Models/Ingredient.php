<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    // set default attr value
    protected $attributes = [
        'ingredient_status' => 1,
        'QTY' => 50,
        'menu_id' => 0,
    ];

    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }
}
