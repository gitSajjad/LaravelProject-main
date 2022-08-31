<?php

namespace App\Http\Requests\Auth\Customer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLoginRegisterRequest extends FormRequest
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
            'otp' => 'required|min:6|max:6',
         ];
    }
}
