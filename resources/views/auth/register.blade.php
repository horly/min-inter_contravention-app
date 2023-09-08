@extends('base')
@section('title', __('se connecter'))
@section('content')

<div class="vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card bg-body-tertiary">
                    <form class="card-body p-5" action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="title-register text-muted text-center p-2">
                            <p class="fw-bold">CONTRAVENTION APP</p>
                            <small>Ajouter un agent</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Nom/Postnom/Prénom*</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nom complet de l'agent" value="{{ old('name') }}">
                            <small class="text-danger">@error('name') {{ $message }} @enderror</small>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                            <small class="text-danger">@error('email') {{ $message }} @enderror</small>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe*</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            <small class="text-danger">@error('password') {{ $message }} @enderror</small>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirmer le mot de passe*</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                            <small class="text-danger">@error('password_confirmation') {{ $message }} @enderror</small>
                        </div>

                        <div class="mb-3">
                            <label for="grade" class="col-sm-4 col-form-label">Grade*</label>
                            <select name="grade" id="grade" class="form-select @error('grade') is-invalid @enderror">
                                <option value="" selected>Selectionnez votre grade</option>

                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>    
                                @endforeach

                            </select>
                            <small class="text-danger">@error('grade') {{ $message }} @enderror</small>
                        </div>

                        <div class="mb-3">
                            <label for="matricule" class="col-sm-4 col-form-label">Matricule*</label>
                            <input type="text" class="form-control @error('matricule') is-invalid @enderror" id="matricule" name="matricule" placeholder="Entrez votre matricule" value="{{ old('matricule') }}">
                            <small class="text-danger">@error('matricule') {{ $message }} @enderror</small>
                        </div>

                        <div class="mb-3">
                            <label for="poste" class="col-sm-4 col-form-label">Poste de police*</label>
                            <select name="poste" id="poste" class="form-select @error('poste') is-invalid @enderror">
                                <option value="" selected>Selectionnez votre poste de police affecté</option>

                                @foreach ($policePostes as $poste)
                                    <option value="{{ $poste->id }}">{{ $poste->name }}</option>
                                @endforeach

                        </select>
                        <small class="text-danger">@error('poste') {{ $message }} @enderror</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Enregistrer</button>
                        </div>
                    </form>
                </div>
            <div>
        <div>        
    <div>
<div>

@endsection