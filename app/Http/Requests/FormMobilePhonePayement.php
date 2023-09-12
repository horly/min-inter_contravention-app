<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormMobilePhonePayement extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'mobile_phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'mobile_phone.required' => 'Veuillez enter le numéro de téléphone S.V.P!',
        ];
    }
}
