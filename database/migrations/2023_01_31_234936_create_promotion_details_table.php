<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotion_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('promotion_detail_ID');
            $table->string('menu_in_promotion');

            $table->foreignIdFor(\App\Models\Promotion::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotion_details');
    }
}
