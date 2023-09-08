/** Data table  */
$('.bootstrap-datatable').DataTable({
    lengthMenu: [
        [5, 10, 20, 50, -1],
        [5, 10, 20, 50, "Tout"]
    ],
    responsive: true,
    "language": {
        "lengthMenu": "Afficher les _MENU_ premiers",
        "zeroRecords": "Aucun enregistrements correspondants trouvés",
        "emptyTable": "Aucune donnée disponible dans le tableau",
        "info": "Affichage de _PAGE_ à _PAGES_ pages sur _MAX_ enregistrements",
        "infoEmpty": "Affichage de 0 à 0 sur 0 entrées",
        "infoFiltered": "filtré à partir de _MAX_ entrées totales",
        "search": "Rechercher",
        "paginate": {
            "first": "Premier",
            "last": "Dernier",
            "next": "Suivant",
            "previous": "Précédent"
        },
    }
});