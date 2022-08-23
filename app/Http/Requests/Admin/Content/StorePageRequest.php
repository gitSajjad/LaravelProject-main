<?php

namespace App\Http\Requests\Admin\content;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRequest extends FormRequest
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

            'title' => 'required|max:300|min:2|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u',
            'body' => 'required|max:600|min:5|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u',
            'tags' => 'required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u',

        ];
    }
}
