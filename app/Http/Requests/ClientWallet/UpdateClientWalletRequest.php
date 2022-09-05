<?php

namespace App\Http\Requests\ClientWallet;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientWalletRequest extends FormRequest
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
            'coin_id' => 'required',
            'amount' => 'required'
        ];
    }
}
