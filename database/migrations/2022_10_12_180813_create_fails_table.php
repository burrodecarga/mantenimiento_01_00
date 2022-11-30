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
        Schema::create('fails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_id')->references('id')->on('equipment')->onDelete('cascade')->onUpdate('cascade');
            $table->string('type');
            $table->boolean('status')->default(1);
            $table->bigInteger('user_id')->nullable();
            $table->datetime('reported_at')->default(now());
            $table->datetime('assigned_at')->default(now());
            $table->datetime('repareid_at')->default(now());
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
        Schema::dropIfExists('fails');
    }
};
