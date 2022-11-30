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
        Schema::create('team_zone', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->references('id')->on('teams')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('zone_id')->references('id')->on('zones')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('team_zone');
    }
};
