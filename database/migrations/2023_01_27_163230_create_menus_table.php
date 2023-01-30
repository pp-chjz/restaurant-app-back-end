<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('menu_id');
            $table->enum('catagories',array('food','drink','main dish','dessert'));
            $table->integer('sort_menu');
            $table->string('name_ENG');
            $table->string('name_TH');
            $table->enum('menu_status',array('in stock','out of stock'));
            $table->float('price');
            $table->integer('QTY');
            $table->string('size');
            $table->longText('comment');

            // $table->foreignIdFor(\App\Models\Recipes::class);
            // $table->foreignIdFor(\App\Models\Promotion::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
