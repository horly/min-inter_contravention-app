<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormContrevention extends FormRequest
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
            //
            'matricule-show-input' => 'required',
            'contre_name' => 'required|regex:/^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/',
            'contre_num_id' => 'required',
            'contre_phone' => 'required',
            'contre_email' => 'required',
            'contre_address' => 'required',

            'infraction' => 'required',
            'montant' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            //
            'matricule-show-input.required' => "Aucun véhicule n'a été affecté!",
            'contre_name.required' => "Le nom du contrevenant est obligatoire!",
            'contre_name.regex' => "Veuillez saisir un nom valide S.V.P!",

            'contre_num_id.required' => "Le numéro de pièce d'identité du contrevenant est obligatoire!",

            'contre_address.required' => "L'adresse du contrevenant est obligatoire!",

            'contre_phone.required' => "Le numéro de téléphone du contrevenant est obligatoire!",

            'contre_email.required' => "L'émail du contrevenant est obligatoire!",
            'contre_email.email' => "L'adresse émail saisi n'est pas valide!",
            
            /**
             * Information sur l'infraction
             */
            'infraction.required' => "Veuillez séléctionner une infraction!",

            'montant.required' => 'Veuillez mentionner le montant S.V.P!',
            'montant.numeric' => 'Veuillez entrer un montant valide S.V.P!',

        ];
    }
}
