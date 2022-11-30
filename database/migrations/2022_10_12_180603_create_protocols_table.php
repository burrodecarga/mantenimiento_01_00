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
        Schema::create('protocols', function (Blueprint $table) {
            $table->id();
            $table->string('specialty_id');
            $table->integer('position')->default(1);
            $table->string('task');
            $table->text('detail')->nullable();
            $table->integer('frecuency')->default(1);//veces al año
            $table->integer('duration')->default(1);//horas
            $table->string('permissions')->default('N/A');
            $table->string('security')->default('N/A');
            $table->integer('workers')->default(1);//# de trabajadores
            $table->string('conditions')->default('maquinaria detenida');
            $table->foreignId('task_id')->references('id')->on('tasks')->ondelete('cascade')->onupdate('cascade');
            // $table->foreignId('prototype_id')->references('id')->on('prototypes')->ondelete('cascade')->onupdate('cascade');
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
        Schema::dropIfExists('protocols');
    }
};
