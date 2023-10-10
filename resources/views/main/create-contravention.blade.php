@extends('base')
@section('title', "Ajouter une contravention")
@section('content')

@include('menu.navbar')

<div class="container container-margin-top">

    @include('message.poste-police')
    
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('app_main') }}">Menu principal</a></li>
          <li class="breadcrumb-item active" aria-current="page">Créer une contravention</li>
        </ol>
    </nav>

    <div class="border p-5 bg-body-tertiary">
        <form action="{{ route('app_add_amande') }}" method="POST">
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
                Information sur le véhicule
            </div>

            <div class="mb-4 row">
                <label for="matricule_search" class="col-sm-4 col-form-label">Numéro de matricule*</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="text" class="form-control" id="matricule_search" name="matricule_search" placeholder="Rechercher un véhicule via le numéro de matricule">
                        <button class="btn btn-primary" type="button" id="btn-search-matricule" url={{ route('app_found_vehicule') }} token={{ csrf_token() }}>
                            <i class="fa-solid fa-magnifying-glass"></i> Rechercher
                        </button>
                    </div>
                    <small class="text-danger" id="matricule_search_error"></small>
                </div>
            </div>

            <div class="mb-4 alert alert-success d-none" role="alert" id="success-vehicule-found">
                <i class="fa-solid fa-car"></i>
                &nbsp;&nbsp;&nbsp;<span id="marque-show"></span>
                &nbsp;&nbsp;&nbsp;<span id="model-show"></span>
                &nbsp;&nbsp;&nbsp;<span id="matricule-show"></span><br><br>
                <a href="#" id="link_info_vehicule" target="_blank">Afficher toutes les formations</a>
            </div>

            <div class="mb-4 alert alert-danger d-none" role="alert" id="error-vehicule-found">
                <i class="fa-solid fa-circle-xmark"></i>
                &nbsp;&nbsp;&nbsp;Aucun véhicule n'a été trouvé avec cette plaque d'immatriculation<br><br>
                <a href="{{ route('app_vehicule_registration') }}" target="_blank">Enregistrer un nouveau véhicule</a>
            </div>


            <input type="hidden" name="matricule-show-input" id="matricule-show-input">

            @error('matricule-show-input')
                <div class="mb-4 alert alert-danger" role="alert" id="no-affect-vehicule">
                    <i class="fa-solid fa-circle-xmark"></i>
                    &nbsp;&nbsp;&nbsp;{{ $message }}
                </div>
            @enderror


            <div class="border-bottom mb-4 fw-bold">
                Information sur le conducteur 
            </div>

            <div class="mb-4 row d-none" id="status_conducteur">
                <label for="status_prop" class="col-sm-4 col-form-label">Status du conduecteur*</label>
                <div class="col-sm-8">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status_prop" id="no_prop_vehicle" value="no_prop" checked>
                        <label class="form-check-label" for="no_prop_vehicle">Non propriétaire du véhicule</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status_prop" id="prop_vehicle" value="prop">
                        <label class="form-check-label" for="prop_vehicle">Propriétaire véhicule</label>
                      </div>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="contre_name" class="col-sm-4 col-form-label">Nom/Postnom/Prénom*</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control conduc_info @error('contre_name') is-invalid @enderror" id="contre_name" name="contre_name" placeholder="Nom complet du contrevenant" value="{{ old('contre_name') }}">
                    <small class="text-danger">@error('contre_name') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="contre_num_id" class="col-sm-4 col-form-label">Numéro pièce d'identité*</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control conduc_info @error('contre_num_id') is-invalid @enderror" id="contre_num_id" name="contre_num_id" placeholder="Numéro pièce d'identité du contrevenant" value="{{ old('contre_num_id') }}">
                    <small class="text-danger">@error('contre_num_id') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="contre_phone" class="col-sm-4 col-form-label">Numéro de téléphone*</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control conduc_info @error('contre_phone') is-invalid @enderror" id="contre_phone" name="contre_phone" placeholder="Numéro de téléphone du contrevenant" value="{{ old('contre_phone') }}">
                    <small class="text-danger">@error('contre_phone') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="contre_email" class="col-sm-4 col-form-label">Email*</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control conduc_info @error('contre_email') is-invalid @enderror" id="contre_email" name="contre_email" placeholder="Email du contrevenant" value="{{ old('contre_email') }}">
                    <small class="text-danger">@error('contre_email') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="contre_address" class="col-sm-4 col-form-label">Adresse*</label>
                <div class="col-sm-8">
                    <textarea class="form-control conduc_info @error('contre_address') is-invalid @enderror" name="contre_address" id="contre_address" rows="4" placeholder="Adresse du contrevenant">{{ old('contre_address') }}</textarea>
                    <small class="text-danger">@error('contre_address') {{ $message }} @enderror</small>
                </div>
            </div>

            <div class="border-bottom mb-4 fw-bold">
                Information sur l'infraction 
            </div>

            <div class="mb-4 row">
                <label for="infraction" class="col-sm-4 col-form-label">Infraction commise*</label>
                <div class="col-sm-8">
                <select name="infraction" id="infraction" class="form-select @error('infraction') is-invalid @enderror" url={{ route('app_get_price_infraction') }} token="{{ csrf_token() }}">
                    <option value="">Selectionnez l'infraction commise</option>

                    @foreach ($infractions as $infraction)
                        <option value="{{ $infraction->id }}">{{ $infraction->name }}</option>
                    @endforeach
                </select>
                <small class="text-danger">@error('infraction') {{ $message }} @enderror</small>
                </div>
            </div>

            {{--
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
            --}}

            <div class="mb-4 row">
                <label for="montant" class="col-sm-4 col-form-label">Montant*</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="number" class="form-control @error('montant') is-invalid @enderror" name="montant" id="montant" placeholder="0.00" value="{{ old('montant') }}" readonly>
                        <span class="input-group-text" id="devise-montant-label">USD</span>
                    </div>
                    <small class="text-danger">@error('montant') {{ $message }} @enderror</small>
                </div>
            </div>

            
            <div class="d-grid gap-2">
                <button class="btn btn-primary save" type="submit">
                Enregistrer
                </button>
                <button class="btn btn-primary btn-loading d-none" type="button" disabled>
                    <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
                    <span role="status">Chargement...</span>
                </button>
            </div> 

        </form>
    </div>
</div>

@endsection