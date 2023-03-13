<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateTransfersTable.
 */
class CreateTransfersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transfers', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('payer_id')->unsigned();
            $table->foreign('payer_id')->references('id')->on('users');
            $table->bigInteger('payee_id')->unsigned();
            $table->foreign('payee_id')->references('id')->on('users');
            $table->bigInteger('transaction_id')->unsigned();
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->decimal('value',10,2);
            $table->integer('transfer_status_id')->unsigned();
            $table->foreign('transfer_status_id')->references('id')->on('transfer_statuses');
            $table->decimal('balance_prior_to_payer_transfer',10,2);
            $table->decimal('balance_prior_to_transfer_from_recipient',10,2);

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
		Schema::drop('transfers');
	}
}
