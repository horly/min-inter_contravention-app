@extends('base')
@section('title', "Menu principal")
@section('content')

@include('menu.navbar')

<div class="container container-margin-top">
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('app_main') }}">Menu principal</a></li>
          <li class="breadcrumb-item active" aria-current="page">Contravention</li>
        </ol>
    </nav>

    <div class="border">
        <div class="border-bottom p-4">
          <a href="{{ route('app_create_contravention') }}" class="btn btn-primary" role="button">
              &nbsp;Ajouter une contravention
          </a>
        </div>

        <div class="p-4">
          <table class="table table-striped table-hover border bootstrap-datatable">
            <thead>
                <th>N°</th>
                <th>Nom de l'agent</th>
                <th>Nom du contrevenant</th>
                <th>Infraction commise</th>
                <th>Montant</th>
                <th>Action</th>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
    </div>
</div>

@endsection