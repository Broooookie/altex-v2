<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->uuid('client_wallet_id');
            $table->foreign('client_wallet_id')->references('id')->on('client_wallets')->onDelete('cascade');
            $table->string('role');
            $table->enum('delegate_type', ['BUY', 'SELL']);
            $table->string('trading_pair');
            $table->string('state');
            $table->string('number_of_order');
            $table->string('order_per_unit');
            $table->string('total_commission');
            $table->string('final_price');
            $table->string('volume');
            $table->string('turnover');
            $table->string('commission_time');
            $table->string('last_modified');
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
        Schema::dropIfExists('orders');
    }
}
