<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    // set default attr value
    protected $attributes = [
        'bill_status' => 1,
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
