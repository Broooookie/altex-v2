<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use UsesUuid;
    //
    protected $fillable = [
        'user_id', 'role', 'membership_level', 'member_miner_level', 'mobile_number', 'email', 'reciever_verification_code_account', 'withdraw_transfer_status', 'state',
        'referal_email', 'client_referal _id', 'agree_to_contract_agreement', 'registered_ip', 'last_logined_ip', 'current_login_ip'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function clientWallet()
    {
        return $this->belongsTo(ClientWallet::class);
    }

    public function clientWithdraws()
    {
        return $this->hasMany(ClientWithdraw::class);
    }

    public function clientDeposits()
    {
        return $this->hasMany(ClientDeposit::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
