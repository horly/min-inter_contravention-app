<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('main.create-contravention');
    }
}
