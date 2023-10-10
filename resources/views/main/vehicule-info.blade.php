@extends('base')
@section('title', "Info contravention")
@section('content')

@include('menu.navbar')

<div class="container container-margin-top">

    @include('message.poste-police')

    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('app_main') }}">Menu principal</a></li>
            <li class="breadcrumb-item"><a href="{{ route('app_vehicule_db') }}">Base de données véhicules</a></li>
            <li class="breadcrumb-item active" aria-current="page">Informations du véhicule</li>
        </ol>
    </nav>

    {{-- On inlut les messages flash--}}
    @include('message.flash-message')

    <div class="border p-5 bg-body-tertiary">

        @php
            $type_vehicules = DB::table('type_vehicules')->where('id', $vehicules->id_type)->first(); 
        @endphp

        <div class="border-bottom mb-4 fw-bold">
            Détails du véhicule
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

        <div class="border-bottom mb-4 fw-bold">
            Information sur le propriétaire
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-user"></i>&nbsp;&nbsp;&nbsp;Nom complet
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $proprietaire->name }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-id-card"></i>&nbsp;&nbsp;&nbsp;Numéro pièce d'identité
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $proprietaire->num_id }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-phone"></i>&nbsp;&nbsp;&nbsp;Numéro de téléphone
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $proprietaire->phone }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;&nbsp;Email
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $proprietaire->email }}</p>
            </div>
        </div>

        <div class="mb-4 row">
            <label class="col-sm-6 col-form-label">
                <i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp;&nbsp;Adresse
            </label>
            <div class="col-sm-6">
                <p class="fw-bold text-primary">{{ $proprietaire->address }}</p>
            </div>
        </div>

        <div class="border-bottom mb-4 fw-bold">
            Liste des amandes liée au véhicule
        </div>

        @php
            $amandes = DB::table('amandes')->where('id_vehicule', $vehicules->id)->get();
        @endphp

        <div class="p-3 border bg-white">
            <table class="table table-striped table-hover border bootstrap-datatable">
                <thead>
                    <th>N°</th>
                    <th>Nom de l'agent</th>
                    <th>Nom du conducteur</th>
                    <th>Infraction commise</th>
                    <th class="text-end">Montant</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($amandes as $amande)
                    <tr>
                        @php
                            //$user = App\Models\User::where('id', $amandesp->id_user)->get();
                            $user = DB::table('users')->where('id', $amande->id_user)->first();
                            $contrevenant = DB::table('conducteurs')->where('id', $amande->id_conduct)->first();
                            $infraction = DB::table('infractions')->where('id',$amande->id_infraction)->first();

                            //dd($user[0])
                        @endphp
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $contrevenant->name }}</td>
                        <td>{{ (strlen($infraction->name) > 23) ? substr($infraction->name,0,20).'...' : $infraction->name }}</td>
                        <td class="text-end">{{ $amande->montant }} USD</td>
                        <td>
                            @if ($amande->status == "NO_PAIED")
                                <p class="text-danger"><i class="fa-solid fa-circle-xmark"></i> Non payé</p>
                            @else
                                <p class="text-success"><i class="fa-solid fa-circle-check text-success"></i> Payé</p>
                            @endif
                        </td>
                        <td><a href="{{ route('app_info_contravention', ['id' => $amande->id ]) }}">Voir</a></td>
                        </tr>
                    @endforeach
                        
                </tbody>
            </table>
        </div>

    <div>

</div>


@endsection