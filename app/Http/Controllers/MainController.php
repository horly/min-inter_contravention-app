<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormDataContravention;
use App\Models\Amande;
use App\Models\Contrevenant;
use App\Models\PolicePoste;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    //
    protected $request;
    
    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function main()
    {
        $user = Auth::user();
        $poste = DB::table('police_postes')->where('id', $user->id_poste)->first();

        //dd($user->id_poste);

        $amandeByPost = DB::table('amandes')
                        ->join('users', 'amandes.id_user', '=', 'users.id')
                        ->where('users.id_poste', $poste->id)
                        ->orderBy('amandes.id', 'desc')
                        ->get();

        $amandes = DB::table('amandes')
                        ->orderBy('amandes.id', 'desc')
                        ->get();
        
        //dd($amandeByPost);

        return view('main.main', compact('amandeByPost', 'amandes'));
    }

    public function createContravention()
    {
        $infractions = DB::table('infractions')->orderBy('name', 'asc')->get();
        $typeVehicules = DB::table('type_vehicules')->orderBy('name', 'asc')->get();

        return view('main.create-contravention', compact('infractions', 'typeVehicules'));
    }

    /**
     * - php artisan make:request FormDataContravention
     *
     *  Emplacement :
     *  App\Http\Requests\FormDataContravention
     */
    public function addContravention(FormDataContravention $requestForm)
    {
        //dd($requestForm->all());
        $user = Auth::user();

        $contre_name = $requestForm->input('contre_name');
        $contre_num_id = $requestForm->input('contre_num_id');
        $contre_address = $requestForm->input('contre_address');
        $contre_phone = $requestForm->input('contre_phone');
        $contre_email = $requestForm->input('contre_email');

        $infraction = $requestForm->input('infraction');
        $devise = $requestForm->input('devise');
        $montant = $requestForm->input('montant');

        $type_vehicule = $requestForm->input('type_vehicule');
        $marque = $requestForm->input('marque');
        $modele = $requestForm->input('modele');
        $matricule_vehicule = $requestForm->input('matricule_vehicule');
        $usage_vehicule = $requestForm->input('usage_vehicule');

        $contrevenant = Contrevenant::create([
            'name' => $contre_name,
            'num_id' => $contre_num_id, 
            'address' => $contre_address, 
            'phone' => $contre_phone,
            'email' => $contre_email,
        ]);

        $vehicule = Vehicule::create([
            'marque' => $marque,
            'model' => $modele,
            'num_matricule' => $matricule_vehicule, 
            'usage' => $usage_vehicule,
            'id_type' => $type_vehicule,
            'id_contrevenant' => $contrevenant->id,
        ]);

        $amande = Amande::create([
            'devise' => $devise,
            'montant' => $montant,
            'id_infraction' => $infraction,
            'id_vehicule' => $vehicule->id,
            'id_user' => $user->id,
            'id_contre' => $contrevenant->id,
        ]);

        return redirect()->route('app_main')->with('success', 'Contravention ajouté avec succès!');
    }

    public function infoContravention($id)
    {
        $amande = DB::table('amandes')
                    ->where('id', $id)
                    ->first();

        return view('main.infos-contravention', compact('amande'));
    }
}
