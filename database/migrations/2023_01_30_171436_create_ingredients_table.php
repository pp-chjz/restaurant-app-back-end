<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ingredient_ID');
            $table->integer('QTY');
            $table->string('ingredient_name_ENG');
            $table->string('ingredient_name_TH');
            $table->enum('ingredient_status',array('in stock','out of stock'));

            $table->foreignIdFor(\App\Models\Recipe::class);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}
