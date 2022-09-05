<?php

namespace App\Http\Requests\TransferCertificate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransferCertificateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $auth = Auth::user();
        if($auth->role == 'CLIENT')
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
            'client_deposit_id' => 'required',
            'image' => 'string',
            'remarks' => 'string',
            'upload_time' => 'string',
            'handler' => 'string',
            'processing_time' => 'required'
        ];
    }
}
