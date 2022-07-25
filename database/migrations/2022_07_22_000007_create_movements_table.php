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
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['income', 'expenses']);
            $table->integer('quantity');
            $table->decimal('amount', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->unsignedBigInteger('cash_register_detail_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('cash_register_detail_id')->references('id')->on('cash_register_details');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id', '')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movements');
    }
};
