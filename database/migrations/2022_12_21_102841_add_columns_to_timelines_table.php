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
        Schema::table('timelines', function (Blueprint $table) {
            $table->string('activity')->nullable()->after('days');
            $table->string('color')->nullable()->after('days');
            $table->boolean('allDay')->default(0)->after('days');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timelines', function (Blueprint $table) {
            $table->dropColumn('activity')->nullable();
            $table->dropColumn('color')->nullable();
            $table->dropColumn('allDay')->default(0);
        });
    }
};
