<?php

namespace App\Http\Requests\ClientWithdraw;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientWithdrawRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $auth = Auth::user();
        if($auth->role == 'ADMINISTRATOR' || $auth->role == 'CLIENT')
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
            'client_id' => 'required',
            'client_wallet_id' => 'required',
            'bchain_name' => 'required',
            'withdraw_address' => 'required',
            'withdraw_amount' => 'required',
            'miner_fee' => 'required',
            
        ]; 
    }
}
