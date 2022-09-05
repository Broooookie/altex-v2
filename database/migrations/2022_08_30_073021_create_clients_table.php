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
            $table->string('nickname')->nullable();
            $table->string('role');
            $table->string('membership_level');
            $table->string('member_miner_level');
            $table->string('mobile_number');
            $table->string('email');
            $table->string('reciever_verification_code_account');
            $table->enum('withdraw_transfer_status', ['ALLOWED', 'NOT_ALLOWED']);
            $table->enum('status', ['USABLE', 'FREEZE_ACCOUNT']);
            $table->string('referal_email')->nullable();
            $table->string('client_referal_id')->nullable();
            $table->enum('agree_to_contract_agreement', ['YES', 'NO']);
            $table->string('registered_ip');
            $table->string('last_logined_ip')->nullable();
            $table->string('current_logined_ip')->nullable();
            $table->string('registered_source')->nullable();
            $table->string('number_of_logins')->default(0);
            $table->string('queue')->nullable();
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
