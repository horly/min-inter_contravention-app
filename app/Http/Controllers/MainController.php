<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormContrevention;
use App\Http\Requests\FormDataProprietaire;
use App\Http\Requests\FormMobilePhonePayement;
use App\Models\Amande;
use App\Models\Conducteur;
use App\Models\PolicePoste;
use App\Models\Proprietaire;
use App\Models\Vehicule;
use App\Services\Email\Email;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    //
    protected $request;
    protected $email;
    
    function __construct(Request $request, Email $email)
    {
        $this->request = $request;
        $this->email = $email;
    }

    public function main()
    {
        $user = Auth::user();

        //dd($user->id_poste);
        $amandes = DB::table('amandes')
                        ->orderBy('amandes.id', 'desc')
                        ->get();
        
        //dd($amandeByPost);

        return view('main.main', compact('amandes'));
    }

    public function createContravention()
    {
        $infractions = DB::table('infractions')->orderBy('name', 'asc')->get();
        $typeVehicules = DB::table('type_vehicules')->orderBy('name', 'asc')->get();

        return view('main.create-contravention', compact('infractions', 'typeVehicules'));
    }

    public function infoContravention($id)
    {
        $amande = DB::table('amandes')
                    ->where('id', $id)
                    ->first();

        return view('main.infos-contravention', compact('amande'));
    }

    public function sendPaymentLink()
    {
        //
        $amandeId = $this->request->input('amandeId');
        $infractionId = $this->request->input('infractionId');
        $contrevenantId = $this->request->input('contrevenantId'); 
        $vehiculeId = $this->request->input('vehiculeId');
        $proprietairesId = $this->request->input('proprietairesId');

        $amande = DB::table('amandes')
                        ->where('id', $amandeId)
                        ->first();

        $infraction = DB::table('infractions')
                        ->where('id', $infractionId)
                        ->first();

        $proprietaires = DB::table('proprietaires')
                        ->where('id', $proprietairesId)
                        ->first();
        
        $vehicule = DB::table('vehicules')
                        ->where('id', $vehiculeId)
                        ->first();

        $conducteurs = DB::table('conducteurs')
                        ->where('id', $contrevenantId)
                        ->first();

        //on génère de nombre aleotoire de 6 chiffres si l'utilisateur choisie de copier coller le code
        $code = "";
        $longeur_code = 6;
        $token = md5(uniqid()) . $conducteurs->id . sha1($conducteurs->email);

        for($i = 0; $i < $longeur_code; $i++)
        {
            $code .= mt_rand(0,9);
        }

        $this->email->sendLinkPayment($conducteurs, $infraction, $amande, $vehicule, $token, $code);

        if($conducteurs->email != $proprietaires->email)
        {
            $this->email->sendDoubleLinkPayment($conducteurs, $proprietaires, $infraction, $amande, $vehicule, $token, $code);
        }

        return redirect()->back()->with('success', 'Rappel envoyé avec succès au contrevenant!');;

        //dd($amande);
    }

    public function paymentLink($token)
    {
        return view('main.payment-link-contravention', compact('token'));
    }

    public function checkPaymentCode()
    {
        $token = $this->request->input('token');
        $code = $this->request->input('code');

        $amande = DB::table('amandes')
                    ->where([
                        'code' => $code,
                        'token' => $token
                    ])->first();

        if($amande){
            return redirect()->route('app_paiement_page', [
                'id' => $amande->id
            ]);
        }else{
            return redirect()->back()->with([
                'danger' => 'Le code renseigné ne correspond à aucun paiement!',
                'code' => $code,
            ]);
        }
    }

    public function paymentPage($id)
    {
        $amande = DB::table('amandes')
                ->where('id', $id)
                ->first();

        return view('main.paiement-page', compact('amande'));
    }

    public function mobilePaymentPage($id)
    {
        $amande = DB::table('amandes')
                ->where('id', $id)
                ->first();

        return view('main.mobile-paiement-page', compact('amande'));
    }

    public function mobilePaymentProcess(FormMobilePhonePayement $formmMobile)
    {
        $mobile_network = $formmMobile->input('mobile_network');
        $mobile_phone = $formmMobile->input('mobile_phone');

        $id = $formmMobile->input('id');

        DB::table('amandes')
            ->where('id', $id)
            ->update([
                'status' => "PAIED",
                'updated_at' => new \DateTimeImmutable
        ]);

        return redirect()->route('app_paiement_page', [
            'id' => $id
        ])->with('success', 'Paiement effectué avec succès!');
    }

    public function vehiculeDb()
    {
        $user = Auth::user();
        $vehiculesAll = DB::table('vehicules')->orderBy('id', 'desc')->get();
        $vehiculesPoste = DB::table('vehicules')
                            ->join('amandes', 'amandes.id_vehicule', '=', 'vehicules.id')
                            ->where('amandes.id_poste', $user->id_poste)
                            ->orderBy('vehicules.id', 'desc')
                            ->get();

        //éviter les duplications
        $vehiculesPoste = $vehiculesPoste->unique('marque');

        return view('main.vehicule-db', compact('vehiculesAll', 'vehiculesPoste'));
    }

    public function vehiculeInfo($num_matricule)
    {
        $vehicules = DB::table('vehicules')->where('num_matricule', $num_matricule)->first();

        $proprietaire = DB::table('proprietaires')->where('id', $vehicules->id_prop)->first();

        //dd($vehicules);

        return view('main.vehicule-info', compact('vehicules', 'proprietaire'));
    }

    public function vehiculeRegis()
    {
        $typeVehicules = DB::table('type_vehicules')->orderBy('name', 'asc')->get();
        return view('main.vehicule-registration', compact('typeVehicules'));
    }

    public function createProprietaire(FormDataProprietaire $requestF)
    {
        $name_pro = $requestF->input('name_prop');
        $mun_id_prop = $requestF->input('mun_id_prop');
        $phone = $requestF->input('phone_prop');
        $email_prop = $requestF->input('email_prop');
        $address_prop = $requestF->input('address_prop');

        $type_vehicule = $requestF->input('type_vehicule');
        $marque = $requestF->input('marque');
        $modele = $requestF->input('modele');
        $matricule_vehicule = $requestF->input('matricule_vehicule');
        $usage_vehicule = $requestF->input('usage_vehicule');

        $vehiculeExist = DB::table('vehicules')
                        ->where('num_matricule', $matricule_vehicule)
                        ->first();

        if(!$vehiculeExist)
        {
            $prop = Proprietaire::create([
                'name' => $name_pro,
                'num_id' => $mun_id_prop,
                'phone' => $phone,
                'email' => $email_prop,
                'address' => $address_prop,
            ]);

            Vehicule::create([
                'marque' => $marque,
                'model' => $modele,
                'id_type' => $type_vehicule,
                'num_matricule' => $matricule_vehicule,
                'usage' => $usage_vehicule,
                'id_prop' => $prop->id,
            ]);

            return redirect()->back()->with('success', "Véhicule enregistré avec succès!");
        }
        else
        {
            return redirect()->back()
                    ->withErrors([
                    'matricule_vehicule' => "Ce numéro de matricule est déjà enregistré avec un autre véhicule",
            ])->withInput();
        }

    }

    public function foundVehicule()
    {
        $matricule = $this->request->input('matricule');

        $vehicule = DB::table('vehicules')
                        ->where('num_matricule', $matricule)
                        ->first();
        
        if($vehicule)
        {
            $link = route('app_vehicule_info', ['num_matricule' => $vehicule->num_matricule]);

            $proprietaire = DB::table('proprietaires')
                        ->where('id', $vehicule->id_prop)
                        ->first();

            return response()->json([
                'code' => 200,
                'vehicule' => $vehicule,
                'status' => 'success',
                'link' => $link,
                'proprietaire' => $proprietaire,
            ]);
        }
        else
        {
            return response()->json([
                'code' => 404, //ressource not found
                'status' => 'error',
            ]);
        }
    }

    public function getInfractionPRice()
    {
        $id_infraction = $this->request->input('infraction');

        $infraction = DB::table('infractions')
                ->where('id', $id_infraction)
                ->first();
        
        return response()->json([
            'code' => 200,
            'infraction' => $infraction,
        ]);
    }

    /**
     * - php artisan make:request FormDataContravention
     *
     *  Emplacement :
     *  App\Http\Requests\FormDataContravention
     */
    public function addAmande(FormContrevention $requestForm)
    {
        //dd($requestForm->all());
        $matricule_show_input = $requestForm->input('matricule-show-input');
        $status_prop = $requestForm->input('status_prop');
        $contre_name = $requestForm->input('contre_name');
        $contre_num_id = $requestForm->input('contre_num_id');
        $contre_phone = $requestForm->input('contre_phone');
        $contre_email = $requestForm->input('contre_email');
        $contre_address = $requestForm->input('contre_address');
        $id_infraction = $requestForm->input('infraction');
        $montant = $requestForm->input('montant');

        $vehicule = DB::table('vehicules')
                        ->where('num_matricule', $matricule_show_input)
                        ->first();

        $infraction = DB::table('infractions')
                        ->where('id', $id_infraction)
                        ->first();

        $proprietaire = DB::table('proprietaires')
                        ->where('id', $vehicule->id_prop)
                        ->first();

        $conducteurs = Conducteur::create([
            'name' => $contre_name,
            'num_id' => $contre_num_id,
            'address' => $contre_address,
            'phone' => $contre_phone,
            'email' => $contre_email,
            'id_vehicule' => $vehicule->id,
        ]);

        $amande = Amande::create([
            'montant' => $montant,
            'id_vehicule' => $vehicule->id,
            'id_infraction' => $id_infraction,
            'id_user' => Auth::user()->id,
            'id_poste' => Auth::user()->policePoste->id,
            'id_conduct' => $conducteurs->id,
        ]);

        //on génère de nombre aleotoire de 6 chiffres si l'utilisateur choisie de copier coller le code
        $code = "";
        $longeur_code = 6;
        $token = md5(uniqid()) . $conducteurs->id . sha1($conducteurs->email);

        for($i = 0; $i < $longeur_code; $i++)
        {
            $code .= mt_rand(0,9);
        }

        $this->email->sendLinkPayment($conducteurs, $infraction, $amande, $vehicule, $token, $code);

        if($status_prop == "no_prop")
        {
            $this->email->sendDoubleLinkPayment($conducteurs, $proprietaire, $infraction, $amande, $vehicule, $token, $code);
        }

        return redirect()->route('app_main')->with('success', "L'amande a été ajouté avec succès");
    }
}
