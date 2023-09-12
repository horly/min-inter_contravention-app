<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $subject }}</title>
</head>
<body>
    <div style="margin-bottom: 20px">
        Bonjour <b>{{ $name }}</b>
    </div>
    
    <div style="margin-bottom: 20px">
        <p>Vous devez vous acquitter de votre amande. Utilisez le code ci-dessous pour achéver votre paiement : </p>
        <h4><b>{{ $code }}</b></h4>
    </div>
    
    <div style="margin-bottom: 20px">
        <p>
            Infraction commise : <b>{{ $infractionName }}</b><br>
            Montant : <b>{{ $montant }} {{ $devise }}</b><br>
            Véhicule : <b>{{ $vehiculeMaque }} {{ $vehiculeModele }}</b><br>
            Numéro matricule : <b>{{ $numMatricule }}</b><br>
            Date : <b>{{ $time_date }}</b>
        </p>
    </div>
    
    <div style="margin-bottom: 20px">
        <p>Veuillez effectuer votre paiement <a target="__blank" href="{{ route('app_payment_link', ['token' => $token]) }}">ici</a>.</p>
    </div>
    
    <div style="margin-bottom: 20px">
        <p>Merci.</p>
    </div>
    
    <div style="margin-bottom: 20px">
        <b>Notre équipe de sécurité.</b>
    </div>
</body>
</html>