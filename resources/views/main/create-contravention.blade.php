@extends('base')
@section('title', "Ajouter une contravention")
@section('content')

@include('menu.navbar')

<div class="container container-margin-top">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('app_main') }}">Menu principal</a></li>
          <li class="breadcrumb-item active" aria-current="page">Créer une contravention</li>
        </ol>
    </nav>

    <div class="border p-5 bg-body-tertiary">
        <form action="{{ route('app_add_contravention') }}" method="POST">
            @csrf
            <div class="border-bottom mb-4 fw-bold">
                Information sur l'agent 
            </div>

            <div class="mb-4 row">
                <label class="col-sm-4 col-form-label">
                    <i class="fa-solid fa-user"></i>&nbsp;&nbsp;&nbsp;Nom/Postnom/Prénom
                </label>
                <div class="col-sm-8">
                    <p class="fw-bold text-primary">{{ Auth::user()->name }}</p>
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-sm-4 col-form-label">
                    <i class="fa-solid fa-certificate"></i>&nbsp;&nbsp;&nbsp;Grade
                </label>
                <div class="col-sm-8">
                    <p class="fw-bold text-primary">{{ Auth::user()->grade->name }}</p>
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-sm-4 col-form-label">
                    <i class="fa-solid fa-id-card-clip"></i>&nbsp;&nbsp;&nbsp;Matricule
                </label>
                <div class="col-sm-8">
                    <p class="fw-bold text-primary">{{ Auth::user()->matricule }}</p>
                </div>
            </div>

            <div class="mb-4 row">
                <label class="col-sm-4 col-form-label">
                    <i class="fa-solid fa-house-lock"></i>&nbsp;&nbsp;&nbsp;Poste de police
                </label>
                <div class="col-sm-8">
                    <p class="fw-bold text-primary">{{ Auth::user()->policePoste->name }}</p>
                </div>
            </div>

            <div class="border-bottom mb-4 fw-bold">
                Information sur le contrevenant 
            </div>

            <div class="mb-4 row">
                <label for="contre_name" class="col-sm-4 col-form-label">Nom/Postnom/Prénom*</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('contre_name') is-invalid @enderror" id="contre_name" name="contre_name" placeholder="Nom complet du contrevenant" value="{{ old('contre_name') }}">
                    <small class="text-danger">@error('contre_name') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="contre_num_id" class="col-sm-4 col-form-label">Numéro pièce d'identité*</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('contre_num_id') is-invalid @enderror" id="contre_num_id" name="contre_num_id" placeholder="Numéro pièce d'identité du contrevenant" value="{{ old('contre_num_id') }}">
                    <small class="text-danger">@error('contre_num_id') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="contre_address" class="col-sm-4 col-form-label">Adresse*</label>
                <div class="col-sm-8">
                    <textarea class="form-control @error('contre_address') is-invalid @enderror" name="contre_address" id="contre_address" rows="4" placeholder="Adresse du contrevenant">{{ old('contre_address') }}</textarea>
                    <small class="text-danger">@error('contre_address') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="contre_phone" class="col-sm-4 col-form-label">Numéro de téléphone*</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('contre_phone') is-invalid @enderror" id="contre_phone" name="contre_phone" placeholder="Numéro de téléphone du contrevenant" value="{{ old('contre_phone') }}">
                    <small class="text-danger">@error('contre_phone') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="contre_email" class="col-sm-4 col-form-label">Email*</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control @error('contre_email') is-invalid @enderror" id="contre_email" name="contre_email" placeholder="Email du contrevenant" value="{{ old('contre_email') }}">
                    <small class="text-danger">@error('contre_email') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="border-bottom mb-4 fw-bold">
                Information sur l'infraction 
            </div>

            <div class="mb-4 row">
                <label for="infraction" class="col-sm-4 col-form-label">Infraction commise*</label>
                <div class="col-sm-8">
                <select name="infraction" id="infraction" class="form-select @error('infraction') is-invalid @enderror">
                    <option value="">Selectionnez l'infraction commise</option>

                    @foreach ($infractions as $infraction)
                        <option value="{{ $infraction->id }}">{{ $infraction->name }}</option>
                    @endforeach
                </select>
                <small class="text-danger">@error('infraction') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="devise" class="col-sm-4 col-form-label">Dévise de l'amande*</label>
                <div class="col-sm-8">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="devise" id="cdf" value="CDF" checked onclick="changeDevise('CDF')">
                        <label class="form-check-label" for="cdf" onclick="changeDevise('CDF')">CDF</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="devise" id="usd" value="USD" onclick="changeDevise('USD')">
                        <label class="form-check-label" for="usd" onclick="changeDevise('USD')">USD</label>
                    </div>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="montant" class="col-sm-4 col-form-label">Montant*</label>
                <div class="col-sm-8">
                    <div class="input-group mb-3">
                        <input type="number" class="form-control @error('montant') is-invalid @enderror" name="montant" id="montant" placeholder="0.00" value="{{ old('montant') }}">
                        <span class="input-group-text" id="devise-montant-label">CDF</span>
                    </div>
                    <small class="text-danger">@error('montant') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="border-bottom mb-4 fw-bold">
                Information sur le véhicule
            </div>

            <div class="mb-4 row">
                <label for="type_vehicule" class="col-sm-4 col-form-label">Type*</label>
                <div class="col-sm-8">
                <select name="type_vehicule" id="type_vehicule" class="form-select @error('type_vehicule') is-invalid @enderror" name="montant"">
                    <option value="" selected>Selectionnez le type du véhicule</option>

                    @foreach ($typeVehicules as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach

                </select>
                <small class="text-danger">@error('type_vehicule') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="marque" class="col-sm-4 col-form-label">Marque*</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('marque') is-invalid @enderror" id="marque" name="marque" placeholder="Marque du véhicule, ex : Toyota" >
                    <small class="text-danger">@error('marque') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="modele" class="col-sm-4 col-form-label">Modèle*</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('modele') is-invalid @enderror" id="modele" name="modele" placeholder="Modèle du véhicule, ex : RAV4" >
                    <small class="text-danger">@error('modele') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="matricule_vehicule" class="col-sm-4 col-form-label">Numéro de matricule*</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('matricule_vehicule') is-invalid @enderror" id="matricule_vehicule" name="matricule_vehicule" placeholder="Numéro de matricule du véhicule" >
                    <small class="text-danger">@error('matricule_vehicule') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="usage_vehicule" class="col-sm-4 col-form-label">Usage*</label>
                <div class="col-sm-8">
                    <select name="usage_vehicule" id="usage_vehicule" class="form-select @error('usage_vehicule') is-invalid @enderror">
                        <option value="" selected>Selectionnez l'usage du véhicule</option>
                        <option value="Personnel">Personnel</option>
                        <option value="Transport">Transport</option>
                    </select>
                    <small class="text-danger">@error('usage_vehicule') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="submit">
                Enregistrer
                </button>
            </div> 

        </form>
    </div>
</div>

@endsection