<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormDataProprietaire extends FormRequest
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
            'name_prop' => 'required|regex:/^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/',
            'mun_id_prop' => 'required',
            'address_prop' => 'required',
            'phone_prop' => 'required',
            'email_prop' => 'required|email',

            //'infraction' => 'required',
            //'montant' => 'required|numeric',

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
            'name_prop.required' => "Le nom du propriétaire est obligatoire!",
            'name_prop.regex' => "Veuillez saisir un nom valide S.V.P!",

            'mun_id_prop.required' => "Le numéro de pièce d'identité du propriétaire est obligatoire!",

            'address_prop.required' => "L'adresse du propriétaire est obligatoire!",

            'phone_prop.required' => "Le numéro de téléphone du propriétaire est obligatoire!",

            'email_prop.required' => "L'émail du propriétaire est obligatoire!",
            'email_prop.email' => "L'adresse émail saisi n'est pas valide!",
            
            /**
             * Information sur l'infraction
             */
            //'infraction.required' => "Veuillez séléctionner une infraction!",

            //'montant.required' => 'Veuillez mentionner le montant S.V.P!',
            //'montant.numeric' => 'Veuillez entrer un montant valide S.V.P!',

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
