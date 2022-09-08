<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class CoinChartData extends Model
{
    //
    use UsesUuid;

    protected $fillable = ['coin_id','date', 'open', 'high', 'low', 'close'];   

    public function coin()
    {
        return $this->belongsTo(Coin::class, 'coin_id', 'id');
    }
}
