<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menu();
        $menu->price = 150.00;
        $menu->menu_id = "false";
        $menu->name_ENG = "tomyum shrimp";
        $menu->name_TH = "ต้มยำกุ้ง";
        // $menu->comment = "ไม่เอาผักเอาน้ำใส";
        // $menu->recipe_id = 0;
        // $menu->promotion_id = 0;
        $menu->save();

        $menu = new Menu();
        $menu->price = 150.00;
        $menu->menu_id = "false";
        $menu->name_ENG = "pad thai";
        $menu->name_TH = "ผัดไทย";
        // $menu->comment = "ไม่เอาผักเอาน้ำใส";
        // $menu->recipe_id = 0;
        // $menu->promotion_id = 0;
        $menu->save();

        $menu = new Menu();
        $menu->price = 150.00;
        $menu->menu_id = "false";
        $menu->name_ENG = "coca cola";
        $menu->name_TH = "โค้ก";
        // $menu->comment = "ไม่เอาผักเอาน้ำใส";
        // $menu->recipe_id = 0;
        // $menu->promotion_id = 0;
        $menu->catagories = 2;
        $menu->save();

        $menu = new Menu();
        $menu->price = 150.00;
        $menu->menu_id = "false";
        $menu->name_ENG = "orange juice";
        $menu->name_TH = "น้ำส้ม";
        // $menu->comment = "ไม่เอาผักเอาน้ำใส";
        // $menu->recipe_id = 0;
        // $menu->promotion_id = 0;
        $menu->catagories = 2;
        $menu->save();

        $menu = new Menu();
        $menu->price = 150.00;
        $menu->menu_id = "false";
        $menu->name_ENG = "pudding";
        $menu->name_TH = "พุดดิ้ง";
        // $menu->comment = "ไม่เอาผักเอาน้ำใส";
        // $menu->recipe_id = 0;
        // $menu->promotion_id = 0;
        $menu->catagories = 3;
        $menu->save();

        $menu = new Menu();
        $menu->price = 150.00;
        $menu->menu_id = "false";
        $menu->name_ENG = "cake";
        $menu->name_TH = "เค้ก";
        // $menu->comment = "ไม่เอาผักเอาน้ำใส";
        // $menu->recipe_id = 0;
        // $menu->promotion_id = 0;
        $menu->catagories = 3;
        $menu->save();


        // Menu::factory(5)->create();
        // Menu::factory()->hasIngredients(2)->create();
    }
}
