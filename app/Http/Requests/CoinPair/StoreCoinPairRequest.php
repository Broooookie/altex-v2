<?php

namespace App\Http\Requests\CoinPair;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCoinPairRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        if($user->role == 'ADMINISTRATOR')
        {
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'partition' => 'required',
            'base_currency' => 'required',
            'open_for_trade_status' => 'required',
            'currency_transaction_status' => 'required',
            'contract_transaction_status' => 'required',
            'automatic_collection_status' =>'required',
            'mainstream_currency_status' => 'required',
            'withdrawal_status' => 'required',
            'contract_delivery_cycle' => 'required',
            'queue_number' => 'required',
            'minimum_withdrawal_amount' => 'required',
            'withdrawal_fee' => 'required',
            'account_balance_limit' => 'required',
            'minimum_sell' => 'required',
            'volume' => 'required',
            'turnover' => 'required',
        ];
    }
}
