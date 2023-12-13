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
        Schema::create('active_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phone_id');
            $table->foreign('phone_id')->references('id')->on('phones')->onDelete('cascade');
            $table->integer('code');
            $table->unique(['phone_id','code']);
            $table->timestamp('expired_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('active_codes');
    }
};
