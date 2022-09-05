<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        if($user->role == 'ADMINISTRATOR' || $user->role == 'CLIENT')
        {
            return true;
        }
        
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $username = $this->request->get("username");
        $email = $this->request->get("email");
        return [
            //
            'username' => ['required', Rule::unique('users')->ignore($username, 'username')],
            'email' => ['required', Rule::unique('users')->ignore($email, 'email')],

            'role' => 'required',
            'mobile_number' => 'required',
            'nickname' => 'nullable',
            'email' => ['required', Rule::unique('clients')->ignore($email, 'email')],
            'reciever_verification_code_account' => 'required',
            'referal_email' => 'nullable',
            'client_referal_id' => 'nullable',
            'agree_to_contract_agreement' => 'required',
        ];
    }
}
