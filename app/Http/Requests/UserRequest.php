<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
       //`name`, `email`, `phone`, `password`,  `address`,

        return [
            'name'     => ['required','string','max:250'],
            'email'    => ['required','email','max:250'],
            'password' => ['required','string','min:9','confirmed'],
            'phone'    => ['required','numeric','unique:users'],
            'city'  =>    ['required','alpha_dash'],
        ];
    }
}
