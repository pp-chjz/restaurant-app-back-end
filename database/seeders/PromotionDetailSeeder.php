<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PromotionDetail;

class PromotionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PromotionDetail::factory(20)->create();
    }
}
