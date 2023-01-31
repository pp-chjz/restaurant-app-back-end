<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_summaries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('menu_summary_ID');
            $table->dateTime('menu_summary_datetime');
            $table->integer('menu_summary_QTY');

            $table->foreignIdFor(\App\Models\Menu::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_summaries');
    }
}
