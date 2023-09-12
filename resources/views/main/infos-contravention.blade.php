@extends('base')
@section('title', "Info contravention")
@section('content')

@include('menu.navbar')

<div class="container container-margin-top">

    @include('message.poste-police')

    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('app_main') }}">Menu principal</a></li>
          <li class="breadcrumb-item active" aria-current="page">Informations contravention</li>
        </ol>
    </nav>

    {{-- On inlut les messages flash--}}
    @include('message.flash-message')

    <div class="border p-5 bg-body-tertiary">
        <div class="border-bottom mb-4 fw-bold">
            Information sur l'agent 
        </div>

        @php
            //$user = App\Models\User::where('id', $amandesp->id_user)->get();
            $user = DB::table('users')->where('id', $amande->id_user)->first();
            $contrevenant = DB::table('contrevenants')->where('id', $amande->id_contre)->first();
            $infraction = DB::table('infractions')->where('id',$amande->id_infraction)->first();

            $grade = DB::table('grades')->where('id', $user->id_grade)->first();
            $policePoste = DB::table('police_postes')->where('id', $user->id_poste)->first();

        @endphp

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-user"></i>&nbsp;&nbsp;&nbsp;Nom/Postnom/Prénom
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $user->name }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-certificate"></i>&nbsp;&nbsp;&nbsp;Grade
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $grade->name }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-id-card-clip"></i>&nbsp;&nbsp;&nbsp;Matricule
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $user->matricule }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-house-lock"></i>&nbsp;&nbsp;&nbsp;Poste de police
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $policePoste->name }}</p>
            </div>
        </div>

        @php
           $contrevenants = DB::table('contrevenants')->where('id', $amande->id_contre)->first(); 
        @endphp

        <div class="border-bottom mb-4 fw-bold">
            Information sur le contrevenant 
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-user"></i>&nbsp;&nbsp;&nbsp;Nom/Postnom/Prénom
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $contrevenants->name }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-address-card"></i>&nbsp;&nbsp;&nbsp;Numéro pièce d'identité
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $contrevenants->num_id }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp;&nbsp;Adresse
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $contrevenants->address }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-square-phone"></i>&nbsp;&nbsp;&nbsp;Numéro de téléphone
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $contrevenants->phone }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;&nbsp;Email
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $contrevenants->email }}</p>
            </div>
        </div>

        @php
            $infractions = DB::table('infractions')->where('id', $amande->id_infraction)->first(); 
        @endphp

        <div class="border-bottom mb-4 fw-bold">
            Information sur l'infraction 
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-triangle-exclamation"></i>&nbsp;&nbsp;&nbsp;Infraction commise
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $infractions->name }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-money-bill"></i>&nbsp;&nbsp;&nbsp;Montant
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $amande->montant }} {{ $amande->devise }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-circle-check"></i>&nbsp;&nbsp;&nbsp;Status
            </label>
            <div class="col-sm-6">
                <p class="fw-bold">
                    @if ($amande->status == "NO_PAIED" )
                        <p class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark"></i> Non payé</p>
                    @else
                        <p class="text-success fw-bold"><i class="fa-solid fa-circle-check text-success"></i> Payé</p>
                    @endif
                </p>
            </div>
        </div>

        @php
            $vehicules = DB::table('vehicules')->where('id', $amande->id_vehicule)->first(); 
            $type_vehicules = DB::table('type_vehicules')->where('id', $vehicules->id_type)->first(); 
        @endphp

        <div class="border-bottom mb-4 fw-bold">
            Information sur le véhicule
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-car-side"></i>&nbsp;&nbsp;&nbsp;Type
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $type_vehicules->name }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-car"></i>&nbsp;&nbsp;&nbsp;Marque
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $vehicules->marque }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-car-rear"></i>&nbsp;&nbsp;&nbsp;Modèle
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $vehicules->model }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-barcode"></i>&nbsp;&nbsp;&nbsp;Numéro de matricule
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $vehicules->num_matricule }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-hand"></i>&nbsp;&nbsp;&nbsp;Usage
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $vehicules->usage }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="d-grid gap-2">
                    @if ($amande->status == "NO_PAIED" && Auth::user()->id == $amande->id_user)
                        <button class="btn btn-primary" type="submit">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Modifier
                        </button>
                    @else
                        <button class="btn btn-primary" type="button" disabled>
                            <i class="fa-solid fa-pen-to-square"></i>
                            Modifier
                        </button>
                    @endif
                </div> 
            </div>
            <div class="col-md-6">
                @if ($amande->status == "NO_PAIED")
                    <form action="{{ route('app_send_payment_link') }}" method="POST">
                        @csrf
                        <input type="hidden" name="amandeId" value="{{ $amande->id }}">
                        <input type="hidden" name="infractionId" value="{{ $infractions->id }}">  
                        <input type="hidden" name="contrevenantId" value="{{ $contrevenants->id }}"> 
                        <input type="hidden" name="vehiculeId" value="{{ $vehicules->id }}">

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary save" type="submit">
                                <i class="fa-solid fa-message"></i>
                                Enoyer un rappel
                            </button>
                            <button class="btn btn-primary btn-loading d-none" type="button" disabled>
                                <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
                                <span role="status">Chargement...</span>
                            </button>
                        </div> 
                    </form>
                @else
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="button" disabled>
                            <i class="fa-solid fa-message"></i>
                            Enoyer un rappel
                        </button>
                    </div> 
                @endif
            </div>
        </div>

    <div>
<div>

@endsection