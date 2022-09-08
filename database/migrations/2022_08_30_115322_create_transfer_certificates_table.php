<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_certificates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uid');
            $table->unsignedBigInteger('client_deposit_id');
            $table->foreign('client_deposit_id')->references('id')->on('client_deposits')->onDelete('cascade');
            $table->string('state');
            $table->string('image');
            $table->string('remarks');
            $table->string('upload_time');
            $table->string('handler');
            $table->string('processing_time');
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
        Schema::dropIfExists('transfer_certificates');
    }
}
