<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientDeposit extends Model
{
    //
    protected $fillable = ['client_id', 'client_wallet_id', 'top_up_account', 'recharge_amount', 'included_in_performance', 'recharge_status', 'account_type', 'ip_address', 'submission_time', 'response_time'];
    
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function clientWallet()
    {
        return $this->belongsTo(ClientWallet::class, 'client_wallet_id', 'id');
    }

    public function transferCertificate()
    {
        return $this->belongsTo(TransferCertificate::class);
    }

    

}
