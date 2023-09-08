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

    <div class="border p-3 bg-body-tertiary">
        <form action="">
            
            <div class="border-bottom mb-4 fw-bold">
                Information sur l'agent 
            </div>

            <div class="mb-4 row">
                <label for="agent-name" class="col-sm-4 col-form-label">Nom/Postnom/Prénom</label>
                <div class="col-sm-8">
                    <p class="fw-bold">{{ Auth::user()->name }}</p>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="grade" class="col-sm-4 col-form-label">Grade</label>
                <div class="col-sm-8">
                    <p class="fw-bold">{{ Auth::user()->grade }}</p>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="matricule" class="col-sm-4 col-form-label">Matricule</label>
                <div class="col-sm-8">
                    <p class="fw-bold">{{ Auth::user()->matricule }}</p>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="post" class="col-sm-4 col-form-label">Poste de police</label>
                <div class="col-sm-8">
                    <p class="fw-bold">{{ Auth::user()->poste_police }}</p>
                </div>
            </div>

            <div class="border-bottom mb-4 fw-bold">
                Information sur le contrevenant 
            </div>

            <div class="mb-4 row">
                <label for="contre-name" class="col-sm-4 col-form-label">Nom/Postnom/Prénom*</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="contre-name" name="contre-name" placeholder="Nom complet du contrevenant" >
                </div>
            </div>

            <div class="mb-4 row">
                <label for="contre-num-id" class="col-sm-4 col-form-label">Numéro pièce d'identité*</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="contre-num-id" name="contre-num-id" placeholder="Numéro pièce d'identité du contrevenant" >
                </div>
            </div>

            <div class="mb-4 row">
                <label for="contre-address" class="col-sm-4 col-form-label">Adresse*</label>
                <div class="col-sm-8">
                <textarea class="form-control" name="contre-address" id="contre-address" rows="4" placeholder="Adresse du contrevenant"></textarea>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="contre-phone" class="col-sm-4 col-form-label">Numéro de téléphone*</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="contre-phone" name="contre-phone" placeholder="Numéro de téléphone du contrevenant" >
                </div>
            </div>

            <div class="mb-4 row">
                <label for="contre-email" class="col-sm-4 col-form-label">Email*</label>
                <div class="col-sm-8">
                <input type="email" class="form-control" id="contre-email" name="contre-email" placeholder="Email du contrevenant" >
                </div>
            </div>

            <div class="border-bottom mb-4 fw-bold">
                Information sur l'infraction 
            </div>

            <div class="mb-4 row">
                <label for="infraction" class="col-sm-4 col-form-label">Infraction commise*</label>
                <div class="col-sm-8">
                <select name="infraction" id="infraction" class="form-select">
                        <option value="" selected>Selectionnez l'infraction commise</option>
                        <option value="">Accélération par le conducteur sur le pont d'être dépassé</option>
                        <option value="">Défaut de casque de protection sur le conducteur du moto</option>
                        <option value="">Arrêt ou stationnement de nuit ou par visibilité insuffisante sans éclairage</option>
                        <option value="">Arrêt ou stationnement interdit</option>
                        <option value="">Changement important de direction sans avertissement préalable (sans clignotant)</option>
                        <option value="">Circulation à gauche, sur chaussée</option>
                </select>
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
                        <input type="text" class="form-control" name="montant" id="montant" placeholder="0.00" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="devise-montant-label">CDF</span>
                    </div>
                </div>
            </div>

            <div class="border-bottom mb-4 fw-bold">
                Information sur le véhicule
            </div>

            <div class="mb-4 row">
                <label for="type-vehicule" class="col-sm-4 col-form-label">Type*</label>
                <div class="col-sm-8">
                <select name="type-vehicule" id="type-vehicule" class="form-select">
                        <option value="" selected>Selectionnez le type du véhicule</option>
                        <option value="">Deux-roues motorisés (moto)</option>
                        <option value="">Trois-roues motorisés (moto tricycle)</option>
                        <option value="">Voitures</option>
                        <option value="">Mini Bus</option>
                        <option value="">Bus</option>
                        <option value="">Camions</option>
                        <option value="">Remorques et semi-remorques </option>
                        <option value="">Engins de chantiers et de damage</option>
                        <option value="">Véhicules agricoles</option>
                </select>
                </div>
            </div>

            <div class="mb-4 row">
                <label for="marque" class="col-sm-4 col-form-label">Marque*</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="marque" name="marque" placeholder="Marque du véhicule, ex : Toyota" >
                </div>
            </div>

            <div class="mb-4 row">
                <label for="modele" class="col-sm-4 col-form-label">Modèle*</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="modele" name="modele" placeholder="Modèle du véhicule, ex : RAV4" >
                </div>
            </div>

            <div class="mb-4 row">
                <label for="matricule-vehicule" class="col-sm-4 col-form-label">Numéro de matricule*</label>
                <div class="col-sm-8">
                <input type="text" class="form-control" id="matricule-vehicule" name="matricule-vehicule" placeholder="Numéro de matricule du véhicule" >
                </div>
            </div>

            <div class="mb-4 row">
                <label for="usage-vehicule" class="col-sm-4 col-form-label">Usage*</label>
                <div class="col-sm-8">
                <select name="usage-vehicule" id="usage-vehicule" class="form-select">
                        <option value="" selected>Selectionnez l'usage du véhicule</option>
                        <option value="">Personnel</option>
                        <option value="">Transport</option>
                </select>
                </div>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-primary" type="button" id="save-contravention">
                Enregistrer
                </button>
            </div> 

        </form>
    </div>
</div>

@endsection