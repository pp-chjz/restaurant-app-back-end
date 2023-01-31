<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuSummary extends Model
{
    use HasFactory;

    // set default attr value
    protected $attributes = [
        'menu_summary_QTY' => 0,
    ];
}
