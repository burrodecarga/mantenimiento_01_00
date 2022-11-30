<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timelines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->unsignedBigInteger('protocol_id');
            $table->unsignedBigInteger('equipment_id');
            $table->string('specialty_id');
            $table->integer('position')->default(1);
            $table->unsignedBigInteger('restriction')->nullable();
            $table->integer('priority')->default(1);
            $table->integer('status')->default(0);
            $table->string('task');
            $table->text('detail')->nullable();
            $table->integer('frecuency')->default(1);//veces al año
            $table->integer('duration')->default(1);//horas
            $table->string('permissions')->default('N/A');
            $table->string('security')->default('N/A');
            $table->integer('workers')->default(1);//# de trabajadores
            $table->string('conditions')->default('maquinaria detenida');
            $table->float('total_replacement', 12, 2)->default(0);
            $table->float('total_supply', 12, 2)->default(0);
            $table->float('total_service', 12, 2)->default(0);
            $table->float('total_workers', 12, 2)->default(0);
            $table->string('workers_id');
            $table->float('total', 12, 2)->default(0);
            $table->datetime('start')->default(now());
            $table->datetime('end')->default(now());
            $table->datetime('done')->default(now());
            $table->float('time', 12, 2)->default(0);
            $table->float('days', 12, 2)->default(0);
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
        Schema::dropIfExists('timelines');
    }
};
