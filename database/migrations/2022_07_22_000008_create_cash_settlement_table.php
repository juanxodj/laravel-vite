<?php

namespace Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cash_settlements', function (Blueprint $table) {
            $table->id();
            $table->integer('bill_200')->default(0);
            $table->integer('bill_100')->default(0);
            $table->integer('bill_50')->default(0);
            $table->integer('bill_20')->default(0);
            $table->integer('bill_10')->default(0);
            $table->integer('bill_5')->default(0);
            $table->integer('bill_1')->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->unsignedBigInteger('cash_register_detail_id');
            $table->timestamps();

            $table->foreign('cash_register_detail_id')->references('id')->on('cash_register_details');
        });
    }

    public function down()
    {
        Schema::dropIfExists('cash_settlements');
    }
};
