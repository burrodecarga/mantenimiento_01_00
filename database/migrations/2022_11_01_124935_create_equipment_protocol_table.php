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
        Schema::create('equipment_protocol', function (Blueprint $table) {
            $table->id();
            $table->string('value')->nullable();
            $table->foreignId('protocol_id')->references('id')->on('protocols')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('equipment_id')->references('id')->on('equipment')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('equipment_protocol');
    }
};
