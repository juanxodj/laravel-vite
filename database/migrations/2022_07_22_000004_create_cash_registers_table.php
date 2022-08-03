<?php

namespace Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cash_registers', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id', '')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cash_registers');
    }
};
