<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablenumber extends Model
{
    use HasFactory;
    // protected $primaryKey = 'table_number_ID';
    // public $incrementing = false;
    // protected $keyType = 'string';

    // set default attr value
    protected $attributes = [
        'tablenum_status' => 3,
        'checkbill_status' => 2,
        'order_id' => 0
    ];

    public $primaryKey = 'tablenumber_id';

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    public function bill()
    {
        return $this->hasMany(Bill::class);
    }

    
}
 