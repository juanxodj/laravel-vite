<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashSettlementTable extends Migration
{
  /**
   * Schema table name to migrate
   * @var string
   */
  public $tableName = 'cash_settlement';

  /**
   * Run the migrations.
   * @table cash_settlement
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->tableName, function (Blueprint $table) {
      $table->id();
      $table->integer('200')->default(0);
      $table->integer('100')->default(0);
      $table->integer('50')->default(0);
      $table->integer('20')->default(0);
      $table->integer('10')->default(0);
      $table->integer('5')->default(0);
      $table->integer('1')->default(0);
      $table->unsignedBigInteger('cash_register_details_id');

      $table->foreign('cash_register_details_id')->references('id')->on('cash_register_details');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists($this->tableName);
  }
}
