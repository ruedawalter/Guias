<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guias', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->bigInteger('servicio_id')->unsigned;
            $table->bigInteger('proveedor_id')->unsigned;
            $table->bigInteger('cliente_id')->unsigned;
            $table->bigInteger('fpago_id')->unsigned;
            $table->double('importe',8, 2);
            $table->double('mservicio',8, 2);
            $table->time('vh',0);
            $table->time('hv',0);
            $table->string('obs',100)->nullable;
            $table->bigInteger('agente_id')->unsigned;
            $table->bigInteger('estado_id')->unsigned;





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
        Schema::dropIfExists('guias');
    }
}
