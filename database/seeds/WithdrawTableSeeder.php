<?php

use App\ClientWithdraw;
use Illuminate\Database\Seeder;

class WithdrawTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $withdraw = ClientWithdraw::create(
            [
                'client_id' => '0d0b13ab-7f97-4a28-ab35-1d4f078548d3',
                'client_wallet_id' => '9e988feb-4350-4eb0-82f8-94fb2f6b9f77',
                'bchain_name' => 'TRC20',
                'withdraw_address' => 'ASDASD',
                'withdraw_amount' => 100, 
                'miner_fee' => 1,
                'arrival_quantity' => 99,
                'state' => 'ONHOLD',
                'application_time' => now(),
                'ip_address' => now(),
            ]
        );
    }
}
