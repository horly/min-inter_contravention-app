function changeDevise(devise){
    let deviseMontant = document.getElementById('devise-montant-label');
    deviseMontant.innerText = devise;
}

$('.save').click(function(){
    $('.save').addClass('d-none');
    $('.btn-loading').removeClass('d-none');
});


$('#btn-search-matricule').click(function(){
    var matricule_search = $('#matricule_search').val();
    //console.log(matricule_search);
    var url = $('#btn-search-matricule').attr('url');
    var token = $('#btn-search-matricule').attr('token');

    //on reintialiser les informations du conducteur
    $('.conduc_info').val("");
    $('.conduc_info').prop('disabled', false);

    if(matricule_search != ""){
        $('#matricule_search_error').text("");
        $('#matricule_search').removeClass('is-invalid');
        
        var response = getVehiculeByIdMat(url, token, matricule_search);

        //console.log(response);

        $('#no-affect-vehicule').addClass('d-none');

        if(response.status != "error"){
            //console.log("success");
            $('#marque-show').text(response.vehicule.marque);
            $('#model-show').text(response.vehicule.model);
            $('#matricule-show').text(response.vehicule.num_matricule);
            $('#matricule-show-input').val(response.vehicule.num_matricule);
            $('#link_info_vehicule').attr('href', response.link);

            $('#status_conducteur').removeClass('d-none');

            $('#no_prop_vehicle').prop('checked', true);
            $('#prop_vehicle').prop('checked', false);

            $('#error-vehicule-found').addClass('d-none');
            $('#success-vehicule-found').removeClass('d-none');
        }else{
            //console.log("error");
            $('#marque-show').text("");
            $('#model-show').text("");
            $('#matricule-show').text("");
            $('#matricule-show-input').val("");
            $('#link_info_vehicule').attr('href', '#');

            $('#status_conducteur').addClass('d-none');

            $('#no_prop_vehicle').prop('checked', true);
            $('#prop_vehicle').prop('checked', false);

            $('#error-vehicule-found').removeClass('d-none');
            $('#success-vehicule-found').addClass('d-none');
        }

    }else {
        $('#matricule_search_error').text("Veuillez saisir le numéro de matricule du véhicule S.V.P!");
        $('#matricule_search').addClass('is-invalid');
    }
});

$('#prop_vehicle').change(function(){
    var url = $('#btn-search-matricule').attr('url');
    var token = $('#btn-search-matricule').attr('token');
    var matricule = $('#matricule-show').text();

    //console.log($('#matricule-show').text());

    var response = getVehiculeByIdMat(url, token, matricule);

    $('#contre_name').val(response.proprietaire.name);
    $('#contre_name').prop('readonly', true);

    $('#contre_num_id').val(response.proprietaire.num_id);
    $('#contre_num_id').prop('readonly', true);

    $('#contre_phone').val(response.proprietaire.phone);
    $('#contre_phone').prop('readonly', true);

    $('#contre_email').val(response.proprietaire.email);
    $('#contre_email').prop('readonly', true);

    $('#contre_address').val(response.proprietaire.address);
    $('#contre_address').prop('readonly', true);
});

$('#no_prop_vehicle').change(function(){
    $('.conduc_info').val("");
    $('.conduc_info').prop('disabled', false);
});


function getVehiculeByIdMat(url, token, matricule){
    var response = null;

    $.ajax({
        type: 'POST',
        url:url,
        data:{
            '_token' : token,
            'matricule' : matricule,
        },
        success:function(data){
            response = data;
        },
        async : false,
    });

    return response;
}

$('#infraction').change(function(){
    var infraction = $('#infraction').val();
    var url = $('#infraction').attr('url');
    var token = $('#infraction').attr('token');

    if(infraction != ""){
        $.ajax({
            type: 'POST',
            url:url,
            data: {
                '_token' : token,
                'infraction' : infraction
            },
            success:function(response){
                $('#montant').val(response.infraction.price);
            }
        });
    }
    else{
        $('#montant').val("");
    }
});