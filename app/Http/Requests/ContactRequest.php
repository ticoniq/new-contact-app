<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|email',
            'phone'         => 'required',
            'address'       => 'required',
            'company_id'    => 'required|exists:companies,id',
        ];
    }

    public function attributes() {
        return [
            'company_id' => 'company'
        ];
    }

    public function messages() {
        return [
            'email.email' => 'Please enter a valid email address',
            '*.required'  => ':attributes field can not be empty'
        ];
    }
}
