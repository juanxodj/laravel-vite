<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovementTable extends Migration
{
  /**
   * Schema table name to migrate
   * @var string
   */
  public $tableName = 'movement';

  /**
   * Run the migrations.
   * @table movement
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->tableName, function (Blueprint $table) {
      $table->id();
      $table->enum('type', ['income', 'expenses']);
      $table->integer('quantity');
      $table->decimal('amount', 12, 2)->default(0);
      $table->decimal('total', 12, 2)->default(0);
      $table->unsignedBigInteger('cash_register_id');
      $table->unsignedBigInteger('product_id');
      $table->unsignedBigInteger('user_id');

      $table->foreign('cash_register_id')->references('id')->on('cash_register');
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
    Schema::dropIfExists($this->tableName);
  }
}
