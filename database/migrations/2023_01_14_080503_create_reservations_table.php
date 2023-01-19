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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('no_reservation')->comment('Contoh RES-000001');
            $table->dateTime('tanggal');
            $table->string('section');
            $table->string('reason');
            $table->string('category');
            $table->string('developer');
            $table->string('model');
            $table->string('article');
            $table->text('remarks')->nullable();
            $table->string('status')->comment('0 Antrian, 1 Approve, 2 InApprove, 3 Complete');
            $table->unsignedBigInteger('user_id');
            $table->dateTime('tanggal_approve_matplan')->nullable();
            $table->dateTime('tanggal_complete_warehouse')->nullable();
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
        Schema::dropIfExists('reservations');
    }
};
