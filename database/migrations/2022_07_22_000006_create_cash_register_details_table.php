<?php

namespace Database\Migrations;

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
        Schema::create('cash_register_details', function (Blueprint $table) {
            $table->id();
            $table->dateTime('opening');
            $table->dateTime('closing')->nullable();
            $table->decimal('initial_balance', 12, 2)->default(0);
            $table->decimal('ending_balance', 12, 2)->default(0);
            $table->enum('status', ['open', 'close']);
            $table->unsignedBigInteger('cash_register_id');
            $table->timestamps();

            $table->foreign('cash_register_id')->references('id')->on('cash_registers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cash_register_details');
    }
};
