@extends('base')
@section('title', "Enregistrement du véhicule")
@section('content')

<div class="container container-margin-top">
    <div class="container">

        @include('message.flash-message')

        <div class="card">
            <div class="card-header">Enregistrement du véhicule</div>
            <div class="card-body p-5">
                <form action="{{ route('app_create_proprietaire') }}" method="POST">
                    @csrf
                    
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
                            <input type="text" class="form-control @error('marque') is-invalid @enderror" id="marque" name="marque" placeholder="Marque du véhicule, ex : Toyota" value="{{ old('marque') }}">
                            <small class="text-danger">@error('marque') {{ $message }} @enderror</small>
                        </div>
                    </div>
        
                    <div class="mb-4 row">
                        <label for="modele" class="col-sm-4 col-form-label">Modèle*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('modele') is-invalid @enderror" id="modele" name="modele" placeholder="Modèle du véhicule, ex : RAV4" value="{{ old('modele') }}">
                            <small class="text-danger">@error('modele') {{ $message }} @enderror</small>
                        </div>
                    </div>
        
                    <div class="mb-4 row">
                        <label for="matricule_vehicule" class="col-sm-4 col-form-label">Numéro de matricule*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('matricule_vehicule') is-invalid @enderror" id="matricule_vehicule" name="matricule_vehicule" placeholder="Numéro de matricule du véhicule" value="{{ old('matricule_vehicule') }}">
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

                    <div class="border-bottom mb-4 fw-bold">
                        Information sur le propriétaire
                    </div>

                    <div class="mb-4 row">
                        <label for="name_prop" class="col-sm-4 col-form-label">Nom/Postnom/Prénom*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('name_prop') is-invalid @enderror" id="name_prop" name="name_prop" placeholder="Nom complet du propriétaire" value="{{ old('name_prop') }}">
                            <small class="text-danger">@error('name_prop') {{ $message }} @enderror</small>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="mun_id_prop" class="col-sm-4 col-form-label">Numéro pièce d'identité*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('mun_id_prop') is-invalid @enderror" id="mun_id_prop" name="mun_id_prop" placeholder="Numéro pièce d'identité du propriétaire" value="{{ old('mun_id_prop') }}">
                            <small class="text-danger">@error('mun_id_prop') {{ $message }} @enderror</small>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="phone_prop" class="col-sm-4 col-form-label">Numéro de téléphone*</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('phone_prop') is-invalid @enderror" id="phone_prop" name="phone_prop" placeholder="Numéro de téléphone du propriétaire" value="{{ old('phone_prop') }}">
                            <small class="text-danger">@error('phone_prop') {{ $message }} @enderror</small>
                        </div>
                    </div>

                    <div class="mb-4 row">
                        <label for="email_prop" class="col-sm-4 col-form-label">Email*</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control @error('email_prop') is-invalid @enderror" id="email_prop" name="email_prop" placeholder="Adresse émail du propriétaire" value="{{ old('email_prop') }}">
                            <small class="text-danger">@error('email_prop') {{ $message }} @enderror</small>
                        </div>
                    </div>


                    <div class="mb-4 row">
                        <label for="address_prop" class="col-sm-4 col-form-label">Adresse*</label>
                        <div class="col-sm-8">
                            <textarea class="form-control @error('address_prop') is-invalid @enderror" name="address_prop" id="address_prop" rows="4" placeholder="Adresse du propriétaire">{{ old('address_prop') }}</textarea>
                            <small class="text-danger">@error('address_prop') {{ $message }} @enderror</small>
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
    </div>
</div>

@endsection