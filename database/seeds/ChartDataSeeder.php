<?php

use App\CoinChartData;
use Illuminate\Database\Seeder;

class ChartDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        CoinChartData::create([
            'date' => '1551128400000',
            'open' => '33',
            'high' => '37.1',
            'low' => '14',
            'close' => '14',
            'volume' => '196'
        ]);

        CoinChartData::create([
            'date' => '1551132000000',
            'open' => '13.7',
            'high' => '30',
            'low' => '6.6',
            'close' => '30',
            'volume' => '206'
        ]);

        CoinChartData::create([
            'date' => '1551135600000',
            'open' => '29.9',
            'high' => '33',
            'low' => '21.3',
            'close' => '21.8',
            'volume' => '74'
        ]);

        CoinChartData::create([
            'date' => '1551139200000',
            'open' => '21.7',
            'high' => '25.9',
            'low' => '18',
            'close' => '24',
            'volume' => '140'
        ]);
        
        CoinChartData::create([
            'date' => '1551142800000',
            'open' => '24.1',
            'high' => '24.1',
            'low' => '24',
            'close' => '24.1',
            'volume' => '29'
        ]);

    }
}
