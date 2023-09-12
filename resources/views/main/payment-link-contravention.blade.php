@extends('base')
@section('title', "Lien de paiement")
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
                            <div class="alert alert-primary" role="alert">
                                <i class="fa-solid fa-circle-question"></i> 
                                Veuillez entrer le code fourni pour valider votre paiement
                            </div>
                        </div>

                        <form action="{{ route('app_check_payment_code') }}" method="POST">
                            @csrf

                            {{-- On inlut les messages flash--}}
                            @include('message.flash-message')

                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="mb-3">
                                <label for="code" class="form-label">Code paiement</label>
                                <input type="number" class="form-control @if (Session::has('code')) is-invalid @endif" id="code" name="code" placeholder="XXXXXX" value="@if (Session::has('code')){{ Session::get('code') }}@endif">
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Valider</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection