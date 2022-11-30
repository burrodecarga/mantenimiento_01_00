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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start');
            $table->time('start_time');
            $table->integer('work_shift')->default(1);
            $table->integer('weekly_shift')->default(44);
            $table->integer('daily_shift')->default(8);
            $table->integer('work_holiday')->default(0);
            $table->integer('work_overtime')->default(0);
            $table->time('work_time');
            $table->integer('rest_hours')->default(1);
            $table->integer('rest_time_hours')->default(4);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('plans');
    }
};
