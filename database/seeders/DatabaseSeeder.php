<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(TablenumberSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(BillSeeder::class);
        $this->call(MenuSeeder::class);
    }
}
