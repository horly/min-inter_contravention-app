<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormDataContravention;
use Illuminate\Http\Request;
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
        return view('main.main');
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
        dd($requestForm->all());
        
    }
}
