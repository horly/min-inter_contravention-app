<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormDataContravention;
use App\Http\Requests\FormMobilePhonePayement;
use App\Models\Amande;
use App\Models\Contrevenant;
use App\Models\PolicePoste;
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

        $amandeByPost = DB::table('amandes')
                        ->where('id_poste', $user->id_poste)
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

        $infractionId = $requestForm->input('infraction');
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
            'id_infraction' => $infractionId,
            'id_vehicule' => $vehicule->id,
            'id_user' => $user->id,
            'id_contre' => $contrevenant->id,
            'id_poste' => $user->id_poste,
        ]);

        $infraction = DB::table('infractions')
                        ->where('id', $infractionId)
                        ->first();

        $this->email->sendLinkPayment($contrevenant, $infraction, $amande, $vehicule);

        return redirect()->route('app_main')->with('success', 'Contravention ajouté avec succès!');
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

        $amande = DB::table('amandes')
                        ->where('id', $amandeId)
                        ->first();

        $infraction = DB::table('infractions')
                        ->where('id', $infractionId)
                        ->first();

        $contrevenant = DB::table('contrevenants')
                        ->where('id', $contrevenantId)
                        ->first();
        
        $vehicule = DB::table('vehicules')
                        ->where('id', $vehiculeId)
                        ->first();
        
        $this->email->sendLinkPayment($contrevenant, $infraction, $amande, $vehicule);

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
}
