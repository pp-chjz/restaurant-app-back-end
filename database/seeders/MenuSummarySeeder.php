<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuSummary;

class MenuSummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuSummary::factory(20)->create();
    }
}
