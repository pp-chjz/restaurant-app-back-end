<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablenumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablenumbers', function (Blueprint $table) {
            $table->id();
            $table->enum('tablenum_status',array('full','occupied','avaliable'));
            $table->enum('checkbill_status',array('calling','not calling'));
            $table->string('tablenumber');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tablenumbers');
    }
}
