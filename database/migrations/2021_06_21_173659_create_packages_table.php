<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('departure_id')->references('id')->on('departures');
            $table->foreignId('departure_point_id')->references('id')->on('points');
            $table->string('sender_name');
            $table->string('sender_phone');
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->integer('weight');
            $table->integer('piece');
            $table->string('type');
            $table->string('content');
            $table->string('status', '20');
            $table->unsignedInteger('payment_by')->nullable();
            $table->dateTime('payment_at')->nullable();
            $table->unsignedInteger('settlement_id')->nullable();
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
        Schema::dropIfExists('packages');
    }
}
