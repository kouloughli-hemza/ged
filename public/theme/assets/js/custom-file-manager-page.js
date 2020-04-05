$(function(){
    'use strict'
    /*$('#arrivee').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd'
    });

    $('#arriveeHour').timepicker();*/
    $("#arrivee,#filterArrivee,#filterCreation,#arrivee-scanner").flatpickr({
        altInput: true,
        altFormat: "Le " + "j F, Y",
        dateFormat: "Y-m-d",
        maxDate: "today",
        locale: "fr"
    });

    $("#arriveeHour,#arriveeHour-scanner").flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        locale: "fr"

    });

});
$('.search-filter').on('click', function(e){
    e.preventDefault();
    var target = $(this).attr('href');
    $(target).addClass('show');
});

$(document).on('click touchstart', function(e){
    e.stopPropagation();

    // closing of sidebar menu when clicking outside of it
    if(!$(e.target).closest('.search-filter').length) {
        var offCanvas = $(e.target).closest('.off-canvas').length;
        if(!offCanvas) {
            //$('.off-canvas.show').removeClass('show');
        }
    }
});

$('.off-canvas .close').on('click', function(e){
    e.preventDefault();
    $(this).closest('.off-canvas').removeClass('show');
});


$('.dropify').dropify({
    messages: {
        default: 'Glissez-déposez un fichier ici ou cliquez',
        replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
        remove:  'Supprimer',
        error:   'Désolé, le fichier trop volumineux'
    }
});

//triggered when modal is about to be shown
$('#previewDocument').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var path = $(e.relatedTarget).data('path');

    //populate the textbox
    $(e.currentTarget).find('#documentSource').attr('src',path);
});

$('#modalViewDetails').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var object = $(e.relatedTarget).data('objet');
    var senderDetails = $(e.relatedTarget).data('expiditeur');
    var receiverDetails = $(e.relatedTarget).data('destinataire');
    var pagesNumberDetails = $(e.relatedTarget).data('nombre_page');
    var arrivalDateDetails = $(e.relatedTarget).data('date_arrivee');
    var diffArrivalDate = $(e.relatedTarget).data('date_arrivee_human');

    var direction = $(e.relatedTarget).data('direction');
    var created_at = $(e.relatedTarget).data('created_at');
    var created_at_humans = $(e.relatedTarget).data('created_at_humans');

    //populate the textbox
    $(e.currentTarget).find('#objectDetails').text(object);
    $(e.currentTarget).find('#senderDetails').text(senderDetails);
    $(e.currentTarget).find('#receiverDetails').text(receiverDetails);
    $(e.currentTarget).find('#pagesNumberDetails').text(pagesNumberDetails);
    $(e.currentTarget).find('#arrivalDateDetails').text(arrivalDateDetails);
    $(e.currentTarget).find('#diffArrivalDate').text(diffArrivalDate);

    $(e.currentTarget).find('#direction').text(direction);
    $(e.currentTarget).find('#created_at').text(created_at);
    $(e.currentTarget).find('#created_at_humans').text(created_at_humans);
});

