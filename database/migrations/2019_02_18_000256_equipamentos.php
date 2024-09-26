<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Equipamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamentos', function (Blueprint $table) {
            
            $table->increments('id');
            $table->text('eqdescricao');
            $table->string('marca');
            $table->string('modelo');
            $table->string('status')->default('Disponível');
            $table->string('codidentificacao')->unique();
            $table->date('dt_aquisicao')->format('d.m.Y');;
            $table->integer('etiqueta');
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
        Schema::dropIfExists('equipamentos');
    }
}
