<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $auth = Auth::user();
        if( $auth->role == 'CLIENT')
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
            'trading_pair' => 'required',
            'number_of_order' => 'required',
            'order_per_unit' => 'required',
            'total_commission' => 'required',
            'final_price' => 'required',
            'volume' => 'required',
            'turnover' => 'required',
            'commission_time' => 'required',
            'last_modified' => 'required',
        ];
    }
}
