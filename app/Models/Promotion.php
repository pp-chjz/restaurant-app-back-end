<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    // public function orderDetails()
    // {
    //     return $this->hasMany(PromotionDetail::class);
    // }
    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
}
