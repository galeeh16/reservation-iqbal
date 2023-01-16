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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('material_code');
            $table->string('material_name');
            $table->string('description');
            $table->string('colour');
            $table->string('size');
            $table->string('uom');
            $table->unsignedInteger('req_qty')->nullable()->default(0);
            $table->unsignedInteger('issue_qty')->nullable()->default(0);
            $table->string('status')->nullable();
            $table->string('information')->nullable();
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
        Schema::dropIfExists('materials');
    }
};
