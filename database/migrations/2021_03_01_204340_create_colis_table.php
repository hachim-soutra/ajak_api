<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colis', function (Blueprint $table) {
            $table->id();
            $table->string('ville_depart');
            $table->string('ville_arrive');
            $table->string('status');
            $table->string('phone');
            $table->string('produit');
            $table->integer('user_id');
            $table->integer('agence_id');
            $table->integer('client_id');
            $table->timestamp('date_livraison')->nullable();
            $table->timestamp('date_arrive')->nullable();
            $table->string('name');
            $table->string('token');
            $table->string('description')->nullable();
            $table->string('adresse');
            $table->double('montant')->nullable();
            $table->integer('livreur_id')->nullable();
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
        Schema::dropIfExists('colis');
    }
}
