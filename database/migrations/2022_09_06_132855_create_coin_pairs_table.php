<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinPairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_pairs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uid');
            $table->unsignedBigInteger('coin_id');
            $table->foreign('coin_id')->references('id')->on('coins')->onDelete('cascade');
            $table->unsignedBigInteger('coin_pair_id');
            $table->foreign('coin_pair_id')->references('id')->on('coins')->onDelete('cascade');
            $table->string('partition');
            $table->enum('open_for_trade_status', ['YES', 'NO']);
            $table->enum('currency_transaction_status', ['YES', 'NO']);
            $table->enum('contract_transaction_status', ['YES', 'NO']);
            $table->enum('automatic_collection_status', ['YES', 'NO']);
            $table->enum('mainstream_currency_status', ['YES', 'NO']);
            $table->enum('withdrawal_status', ['YES', 'NO']);
            $table->string('contract_delivery_cycle');
            $table->string('queue_number');   
            $table->string('minimum_withdrawal_amount');
            $table->string('withdrawal_fee');
            $table->string('account_balance_limit');
            $table->string('minimum_sell');
            $table->double('volume');
            $table->double('turnover');
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
        Schema::dropIfExists('coin_pairs');
    }
}
