<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_order', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Order::class);
            $table->foreignIdFor(\App\Models\Menu::class);

            $table->integer('table')->nullable();;
            $table->string('table_str')->nullable();;
            $table->enum('status',array('not complete','complete'))->nullable();;
            $table->enum('food_status',array('prepare','served'))->nullable();;

            $table->longText('comment')->nullable();;
            $table->dateTime('order_time')->nullable();;
            $table->dateTime('complete_at')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_order');
    }
}