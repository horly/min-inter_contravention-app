@extends('base')
@section('title', __('se connecter'))
@section('content')

<div class="vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">

                <div class="card bg-body-tertiary">
                    <div class="card-body p-5">
        
                        <div class="title-register text-muted text-center p-4">
                            <img class="rounded mx-auto d-block mb-4" src="{{ asset('assets/img/logo/armoiries RDC.png') }}" alt="" srcset="" width="70">
                            <p class="fw-bold">CONTRAVENTION APP</p>
                            <small>Se connecter</small>
                        </div>

                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            @error('email')
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                            @error('password')
                                <div class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="name@example.com" value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-lebel" for="remember">Se souvenir de moi</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Se connecter</button>
                            </div>
                        </form>
                    </div>
                </div>
            <div>
        <div>        
    <div>
<div>
@endsection