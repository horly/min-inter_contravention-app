@extends('base')
@section('title', __('se connecter'))
@section('content')

<div class="vh-100 d-flex align-items-center bg-body-tertiary">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <p class="text-center text-muted">CONTRAVENTION APP</p>
                <p class="text-muted text-center h5 mb-5">Ajouter un agent</p>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    
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
                            <option value="Commissaire">Commissaire</option>
                            <option value="Commissaire adjoint">Commissaire adjoint</option>
                            <option value="Commissaire principal">Commissaire principal</option>
                            <option value="Sous-commissaire principal">Sous-commissaire principal</option>
                            <option value="Sous-commissaire">Sous-commissaire</option>
                            <option value="Sous-commissaire adjoint">Sous-commissaire adjoint</option>
                            <option value="Brigadier en chef">Brigadier en chef</option>
                            <option value="Brigadier">Brigadier</option>
                            <option value="Brigadier adjoint">Brigadier adjoint</option>
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
                            <option value="Ngaliema">Ngaliema</option>
                            <option value="Kinshasa">Kinshasa</option>
                            <option value="Kintambo">Kintambo</option>
                            <option value="Kasa-vubu">Kasa-vubu</option>
                      </select>
                      <small class="text-danger">@error('poste') {{ $message }} @enderror</small>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Enregistrer</button>
                    </div>
                </form>
            <div>
        <div>        
    <div>
<div>

@endsection