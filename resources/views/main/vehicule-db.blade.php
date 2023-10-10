@extends('base')
@section('title', "Base des données vehicules")
@section('content')

@include('menu.navbar')

<div class="container container-margin-top">

    @include('message.poste-police')

    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('app_main') }}">Menu principal</a></li>
          <li class="breadcrumb-item active" aria-current="page">Base de données véhicules</li>
        </ol>
    </nav>

     {{-- On inlut les messages flash--}}
     @include('message.flash-message')

     <div class="border">
 
         <div class="p-4">

            <a href="{{ route('app_vehicule_registration') }}" class="btn btn-primary mb-4" target="_blank" role="button"><i class="fa-solid fa-car"></i> Enregistrer un nouveau véhicule</a>

           <table class="table table-striped table-hover border bootstrap-datatable">
             <thead>
                 <th>N°</th>
                 <th>Type</th>
                 <th>Marque</th>
                 <th>Modèle</th>
                 <th>N° matricule</th>
                 <th>Action</th>
             </thead>
             <tbody>
                @foreach ($vehiculesAll as $vehicule)
                    @php
                        $typeV = DB::table('type_vehicules')->where('id', $vehicule->id_type)->first();
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $typeV->name }}</td>
                        <td>{{ $vehicule->marque }}</td>
                        <td>{{ $vehicule->model }}</td>
                        <td>{{ $vehicule->num_matricule }}</td>
                        <td><a href="{{ route('app_vehicule_info', ['num_matricule' => $vehicule->num_matricule]) }}">Voir</a></td>
                    </tr>
                @endforeach
                   
             </tbody>
           </table>
         </div>
     </div>

</div>


@endsection