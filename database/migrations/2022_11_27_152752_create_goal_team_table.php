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
        Schema::create('goal_team', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->references('id')->on('teams')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('goal_id')->references('id')->on('goals')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('goal_team');
    }
};
