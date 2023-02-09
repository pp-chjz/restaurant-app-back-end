<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredient = new Ingredient();
        $ingredient->ingredient_ID = "ingredient_ID" ;
        $ingredient->ingredient_name_ENG = "pork";
        $ingredient->ingredient_name_TH = "หมู";
        $ingredient->recipe_id = 0;
        $ingredient->save();

        $ingredient = new Ingredient();
        $ingredient->ingredient_ID = "ingredient_ID";
        $ingredient->ingredient_name_ENG = "crispy pork";
        $ingredient->ingredient_name_TH = "หมูกรอบ";
        $ingredient->recipe_id = 0;
        $ingredient->save();

        $ingredient = new Ingredient();
        $ingredient->ingredient_ID = "ingredient_ID";
        $ingredient->ingredient_name_ENG = "crab";
        $ingredient->ingredient_name_TH = "ปู";
        $ingredient->recipe_id = 0;
        $ingredient->save();

        $ingredient = new Ingredient();
        $ingredient->ingredient_ID = "ingredient_ID";
        $ingredient->ingredient_name_ENG = "shrimp";
        $ingredient->ingredient_name_TH = "กุ้ง";
        $ingredient->recipe_id = 0;
        $ingredient->save();

        $ingredient = new Ingredient();
        $ingredient->ingredient_ID = "ingredient_ID";
        $ingredient->ingredient_name_ENG = "squid";
        $ingredient->ingredient_name_TH = "ปลาหมึก";
        $ingredient->recipe_id = 0;
        $ingredient->save();

        $ingredient = new Ingredient();
        $ingredient->ingredient_ID = "ingredient_ID";
        $ingredient->ingredient_name_ENG = "shell";
        $ingredient->ingredient_name_TH = "หอย";
        $ingredient->recipe_id = 0;
        $ingredient->save();

        $ingredient = new Ingredient();
        $ingredient->ingredient_ID = "ingredient_ID";
        $ingredient->ingredient_name_ENG = "snapper fish";
        $ingredient->ingredient_name_TH = "ปลากระพง";
        $ingredient->recipe_id = 0;
        $ingredient->save();

        $ingredient = new Ingredient();
        $ingredient->ingredient_ID = "ingredient_ID";
        $ingredient->ingredient_name_ENG = "vegetable";
        $ingredient->ingredient_name_TH = "ผัก";
        $ingredient->recipe_id = 0;
        $ingredient->save();


        $ingredient = new Ingredient();
        $ingredient->ingredient_ID = "ingredient_ID";
        $ingredient->ingredient_name_ENG = "morning glory";
        $ingredient->ingredient_name_TH = "ผักบุ้ง";
        $ingredient->recipe_id = 0;
        $ingredient->save();


        // Ingredient::factory(20)->create();
        Ingredient::factory()->hasMenus(3)->create();
    }
}
