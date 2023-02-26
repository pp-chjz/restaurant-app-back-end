<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodTable;


class FoodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FoodTable::factory(20)->create();
        
    }
}
