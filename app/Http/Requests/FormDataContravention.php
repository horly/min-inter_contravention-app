<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDataContravention extends FormRequest
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
            'contre_name' => 'required|regex:/^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/',
            'contre_num_id' => 'required',
            'contre_address' => 'required',
            'contre_phone' => 'required',
            'contre_email' => 'required|email',

            'infraction' => 'required',
            'montant' => 'required|numeric',

            'type_vehicule' => 'required',
            'marque' => 'required',
            'modele' => 'required',
            'matricule_vehicule' => 'required',
            'usage_vehicule' => 'required',
        ];
    }

    public function messages()
    {
        return [
            //
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

            /**
             * Information sur le véhicule
             */
            'type_vehicule.required' => "Veuillez séléctionner le type du véhicule S.V.P!",
            'marque.required' => "Veuillez saisir la marque du véhicule S.V.P!",
            'modele.required' => "Veuillez saisir le modèle du véhicule S.V.P!",
            'matricule_vehicule.required' => "Veuillez saisir le numéro de matricule du véhicule S.V.P!",
            'usage_vehicule.required' => "Veuillez séléctionner l'usage du véhicule S.V.P!",
        ];
    }
}
