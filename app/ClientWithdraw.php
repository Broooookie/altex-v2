<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientWithdraw extends Model
{
    //
    protected $fillable = ['client_id', 'client_wallet_id', 'bchain_name', 'withdrawal_address', 'withdrawal_amount', 'miner_fee', 'arrival_quantity', 'state', 'application_time', 'ip_address'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function clientWallet()
    {
        return $this->belongsTo(ClientWallet::class, 'client_wallet_id', 'id');
    }
}
