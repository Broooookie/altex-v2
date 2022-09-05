<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class ClientWallet extends Model
{
    use UsesUuid;
    //
    protected $fillable = ['client_id', 'coin_id', 'wallet_balance'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function coin()
    {
        return $this->belongsTo(Coin::class, 'coin_id', 'coin');
    }

    public function clientDeposits()
    {
        return $this->hasMany(ClientDeposit::class);
    }

    public function clientWithdraws()
    {
        return $this->hasMany(ClientWithdraw::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
