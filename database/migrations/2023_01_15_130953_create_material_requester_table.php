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
        Schema::create('material_requester', function (Blueprint $table) {
            $table->id();
            // $table->string('material_code');
            // $table->string('description');
            // $table->string('colour');
            // $table->string('uom');
            // $table->string('status')->nullable();
            
            $table->unsignedInteger('req_qty')->nullable()->default(0);
            $table->unsignedInteger('issue_qty')->nullable()->default(0);
            $table->string('code_item')->nullable();
            $table->string('size')->nullable();
            $table->string('stage_and_season')->nullable();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('material_requester');
    }
};
