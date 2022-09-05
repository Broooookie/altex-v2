<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_withdraws', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->uuid('client_wallet_id');
            $table->foreign('client_wallet_id')->references('id')->on('clients')->onDelete('cascade');
            $table->string('bchain_name');
            $table->string('withdraw_address');
            $table->string('withdraw_amount');
            $table->string('miner_fee');
            $table->string('arrival_quantity');
            $table->enum('state', ['PENDING', 'APPROVED', 'DISSAPROVED']);
            $table->string('application_time');
            $table->string('ip_address');
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
        Schema::dropIfExists('client_withdraws');
    }
}
