<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_tables', function (Blueprint $table) {
            $table->id();
            $table->enum('tablenum_status',array('full','occupied','avaliable'));
            $table->enum('checkbill_status',array('calling','not calling'));
            $table->string('tablenumber');
            $table->integer('have_order');
            $table->timestamps();
            $table->softDeletes();

            $table->foreignIdFor(\App\Models\Order::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_tables');
    }
}
