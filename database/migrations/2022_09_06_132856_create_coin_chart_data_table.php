<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinChartDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coin_chart_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uid');
            $table->unsignedBigInteger('coin_pair_id');
            $table->foreign('coin_pair_id')->references('id')->on('coin_pairs')->onDelete('cascade');
            $table->string('date');
            $table->string('open');
            $table->string('high');
            $table->string('low');
            $table->string('close');
            $table->string('coin_volume');
            $table->string('increase_in_value');
            $table->double('price_range_from');
            $table->double('price_range_to');
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
        Schema::dropIfExists('coin_chart_data');
    }
}
