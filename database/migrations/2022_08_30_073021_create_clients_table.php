<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('role');
            $table->string('membership_level');
            $table->string('member_miner_level');
            $table->string('mobile_number');
            $table->string('email');
            $table->string('reciever_verification_code_account');
            $table->string('withdraw_transfer_status');
            $table->string('state');
            $table->string('referal_email')->nullable();
            $table->string('client_referal_id')->nullable();
            $table->string('agree_to_contract_agreement');
            $table->string('registered_ip');
            $table->string('last_logined_ip')->nullable();
            $table->string('current_logined_ip')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
