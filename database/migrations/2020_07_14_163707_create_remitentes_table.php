<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemitentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('remitentes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',60);
            $table->string('telefono',10);
            $table->string('cel',9);
            $table->string('direccion',100);
            $table->string('email',100);
            $table->bigInteger('distrito_id')->unsigned;         
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
        Schema::dropIfExists('remitentes');
    }
}
