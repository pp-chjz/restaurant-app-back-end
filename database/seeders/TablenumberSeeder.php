<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tablenumber;

class TablenumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $tablenumber = new Tablenumber();
        // $tablenumber->tablenumber = "100";
        // $tablenumber->save();

        Tablenumber::factory(20)->create();
    }
}
