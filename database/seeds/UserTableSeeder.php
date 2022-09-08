<?php

use App\Client;
use App\ClientWallet;
use App\ClientWithdraw;
use App\Coin;
use App\Hospital;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'username' => 'administrator',
            'password' => 'administrator',
            'username' => 'administrator',
            'role' => 'ADMINISTRATOR',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        /** Customer */
        $userClient = User::create([
            'username' => 'client',
            'password' => 'client123',
            'role' => 'CLIENT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $client = Client::create([
            'user_id' => $userClient->id,
            'role' => 'CLIENT',
            'membership_level' => 'VIP1',
            'member_miner_level' => 0,
            'mobile_number' => '09664375522',
            'email' => 'janedoe@gmail.com',
            'reciever_verification_code_account' => 'X1552',
            'withdraw_transfer_status' => 'NOT_ALLOWED',
            'status' => 'USABLE',
            'referal_email' => 'johndoe@gmail.com',
            'client_referal_id' => 1,
            'agree_to_contract_agreement' => 'YES', 
            'registered_ip' => '127.0.0.1',
            'last_logined_ip' => '127.0.0.1',
            'current_logined_ip' => '127.0.0.1',
            'registered_source' => 'asd',
            'number_of_logins' => 0,
            'queue' => 0
        ]);

        $coin = Coin::create([
            // 'client_id' => $client->id,
            'name' => 'USDT',
            'logo' => 'usdt',
        ]);

        $clientWallet = ClientWallet::create([
            'client_id' => $client->id,
            'coin_id' => $coin->id,
            'wallet_balance' => 100000,
        ]);


        $withdraw = ClientWithdraw::create(
            [
                'client_id' => $client->id,
                'client_wallet_id' => $clientWallet->id,
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

        ClientWithdraw::create(
            [
                'client_id' => $client->id,
                'client_wallet_id' => $clientWallet->id,
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
        ClientWithdraw::create(
            [
                'client_id' => $client->id,
                'client_wallet_id' => $clientWallet->id,
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
        ClientWithdraw::create(
            [
                'client_id' => $client->id,
                'client_wallet_id' => $clientWallet->id,
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
