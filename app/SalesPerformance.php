<?php

namespace App;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;

class SalesPerformance extends Model
{
    //
    use UsesUuid;
    
    protected $fillable = [
        'client_id', 'cumulative_deposit', 'cumulative_withdrawal', 'performance', 'commission'
    ];

    public function client()
    {
        return  $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
