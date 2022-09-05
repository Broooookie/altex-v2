<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $fillable = ['client_id', 'role', 'client_wallet_id', 'delegate_type', 'trading_pair', 'state', 'number_of_order', 'order_per_unit', 'total_commission', 'final_price', 'volume', 'turnover', 'commission_time', 'last_modified'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function clientWallet()
    {
        return $this->belongsTo(ClientWallet::class, 'client_wallet_id', 'id');
    }
}
