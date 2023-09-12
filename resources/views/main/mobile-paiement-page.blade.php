@extends('base')
@section('title', "Paiement mobile")
@section('content')

<div class="vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card bg-body-tertiary">
                    <div class="card-body p-5">
                        <div class="text-center mb-3">
                            <h4 class="mb-3">Paiement mobile</h4>
                            <small>Paiement de la contravention</small>
                        </div>

                        <h3 class="text-center"><span class="badge bg-primary">{{ $amande->montant }} {{ $amande->devise }}</span></h3>
                        
                        <form action="{{ route('app_mobile_payment_process') }}" method="POST">
                            @csrf

                            <input type="hidden" name="id" value="{{ $amande->id }}">

                            <div class="mb-3">
                                <label for="mobile_network" class="form-label">Réseau mobile</label>
                                <select class="form-select" name="mobile_network" id="mobile_network">
                                    <option value="orange" selected>Orange Money</option>
                                    <option value="vodacom">Mpsa</option>
                                    <option value="airtel">Airtel Money</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="mobile_phone" class="form-label">Numéro de téléphone</label>
                                <input type="number" class="form-control @error('mobile_phone') is-invalid @enderror" name="mobile_phone" id="mobile_phone" value="{{ old('mobile_phone') }}">
                                <small class="text-danger">@error('mobile_phone') {{ $message }} @enderror</small>
                            </div>

                            <div class="d-grid gap-2 mb-4">
                                <button class="btn btn-success save" type="submit">
                                    Payer
                                </button>
                                <button class="btn btn-success btn-loading d-none" type="button" disabled>
                                    <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
                                    <span role="status">Chargement...</span>
                                </button>
                            </div> 
                            
                            <img class="img-fluid mx-auto d-block" src="{{ asset('assets/img/mobile-money.png') }}" width="500" alt="">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection