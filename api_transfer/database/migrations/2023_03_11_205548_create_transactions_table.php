<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTransactionsTable.
 */
class CreateTransactionsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transactions', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('payer_id')->unsigned();
            $table->foreign('payer_id')->references('id')->on('users');
            $table->bigInteger('payee_id')->unsigned();
            $table->foreign('payee_id')->references('id')->on('users');
            $table->integer('transaction_status_id')->unsigned();
            $table->foreign('transaction_status_id')->references('id')->on('transaction_statuses');
            $table->decimal('value',10,2);
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
		Schema::drop('transactions');
	}
}
