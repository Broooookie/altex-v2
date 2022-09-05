<?php

namespace App\Http\Requests\Coin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoinRequest extends FormRequest
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
        $name = $this->request->get("name");
        return [
            'name' => ['required', Rule::unique('coins')->ignore($name, 'name')],
            'logo' => 'string'
        ];
    }
}
