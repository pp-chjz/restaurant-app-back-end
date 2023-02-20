<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('cancel_status',array('not cancel','cancel'));
            $table->enum('order_status',array('prepare','cooking','complete'));
            $table->float('total_price');
            $table->dateTime('order_time');
            $table->string('order_id');

            $table->foreignIdFor(\App\Models\Tablenumber::class);
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
        Schema::dropIfExists('orders');
    }
}
