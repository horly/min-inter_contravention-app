function changeDevise(devise){
    let deviseMontant = document.getElementById('devise-montant-label');
    deviseMontant.innerText = devise;
}

$('.save').click(function(){
    $('.save').addClass('d-none');
    $('.btn-loading').removeClass('d-none');
});