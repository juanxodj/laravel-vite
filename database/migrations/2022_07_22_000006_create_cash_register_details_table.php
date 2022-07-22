<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashRegisterDetailsTable extends Migration
{
  /**
   * Schema table name to migrate
   * @var string
   */
  public $tableName = 'cash_register_details';

  /**
   * Run the migrations.
   * @table cash_register_details
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->tableName, function (Blueprint $table) {
      $table->id();
      $table->dateTime('opening');
      $table->dateTime('closing')->nullable();
      $table->decimal('initial_balance', 12, 2)->default(0);
      $table->decimal('ending_balance', 12, 2)->default(0);
      $table->enum('status', ['open', 'close']);
      $table->unsignedBigInteger('cash_register_id');

      $table->foreign('cash_register_id')->references('id')->on('books');
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
