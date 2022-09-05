<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        
        return true;
        
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
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:8',
            'email' => 'required|unique:users',

            'role' => 'required',
            'mobile_number' => 'required',
            'nickname' => 'nullable',
            'email' => 'required|unique:clients',
            'reciever_verification_code_account' => 'required',
            'referal_email' => 'nullable',
            'client_referal_id' => 'nullable',
            'agree_to_contract_agreement' => 'required',
            'membership_level' => 'required',
            'member_miner_level' => 'required',
            'withdraw_transfer_status' => 'required',
            ''
          ];
    }
}
