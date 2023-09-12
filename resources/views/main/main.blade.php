@extends('base')
@section('title', "Menu principal")
@section('content')

@include('menu.navbar')

<div class="container container-margin-top">

    @include('message.poste-police')

    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('app_main') }}">Menu principal</a></li>
          <li class="breadcrumb-item active" aria-current="page">Contravention</li>
        </ol>
    </nav>

    {{-- On inlut les messages flash--}}
    @include('message.flash-message')

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
                <th class="text-end">Montant</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
              @if (Auth::user()->role == "ADMIN")
                @foreach ($amandes as $amande)
                <tr>
                  @php
                    //$user = App\Models\User::where('id', $amandesp->id_user)->get();
                    $user = DB::table('users')->where('id', $amande->id_user)->first();
                    $contrevenant = DB::table('contrevenants')->where('id', $amande->id_contre)->first();
                    $infraction = DB::table('infractions')->where('id',$amande->id_infraction)->first();

                    //dd($user[0])
                  @endphp
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $contrevenant->name }}</td>
                  <td>{{ (strlen($infraction->name) > 23) ? substr($infraction->name,0,20).'...' : $infraction->name }}</td>
                  <td class="text-end">{{ $amande->montant }} {{ $amande->devise }}</td>
                  <td>
                      @if ($amande->status == "NO_PAIED")
                        <p class="text-danger"><i class="fa-solid fa-circle-xmark"></i> Non payé</p>
                      @else
                        <p class="text-success"><i class="fa-solid fa-circle-check text-success"></i> Payé</p>
                      @endif
                  </td>
                  <td><a href="{{ route('app_info_contravention', ['id' => $amande->id ]) }}">Voir</a></td>
                </tr>
              @endforeach
              @else
                @foreach ($amandeByPost as $amandesp)
                <tr>
                  @php
                    //$user = App\Models\User::where('id', $amandesp->id_user)->get();
                    $user = DB::table('users')->where('id', $amandesp->id_user)->first();
                    $contrevenant = DB::table('contrevenants')->where('id', $amandesp->id_contre)->first();
                    $infraction = DB::table('infractions')->where('id',$amandesp->id_infraction)->first();

                    //dd($user[0])
                  @endphp
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $contrevenant->name }}</td>
                  <td>{{  (strlen($infraction->name) > 23) ? substr($infraction->name,0,20).'...' : $infraction->name }}</td>
                  <td class="text-end">{{ $amandesp->montant }} {{ $amandesp->devise }}</td>
                  <td>
                    @if ($amandesp->status == "NO_PAIED")
                      <p class="text-danger"><i class="fa-solid fa-circle-xmark"></i> Non payé</p>
                    @else
                      <p class="text-success"><i class="fa-solid fa-circle-check text-success"></i> Payé</p>
                    @endif
                </td>
                  <td><a href="{{ route('app_info_contravention', ['id' => $amandesp->id ]) }}">Voir</a></td>
                </tr>
                @endforeach
              @endif
                
            </tbody>
          </table>
        </div>
    </div>
</div>

@endsection