<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Reservas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer ('fkequipamentos')->unsigned()->unique();
            $table->foreign('fkequipamentos')->references('id')->on('equipamentos');
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');


            $table->string('horario');
            $table->date('dtagendamento');
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
        Schema::dropIfExists('reservas');
    }
}
