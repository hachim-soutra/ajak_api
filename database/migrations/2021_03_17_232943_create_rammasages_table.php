<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRammasagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rammasages', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('colis_id');
            $table->integer('quantity')->default('1');
            $table->integer('agence_id');
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
        Schema::dropIfExists('rammasages');
    }
}
