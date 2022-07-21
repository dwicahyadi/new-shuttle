<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('departure_point_id')->nullable();
            $table->boolean('checked_in')->default(false);
        });
        Schema::table('reservations', function (Blueprint $table) {
            $table->string('note')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('departure_point_id');
            $table->dropColumn('checked_in');
        });
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('note');
        });
    }
}
