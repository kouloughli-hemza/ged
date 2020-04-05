
$(function(){
  'use strict'

  feather.replace();

  ////////// NAVBAR //////////

  // Initialize PerfectScrollbar of navbar menu for mobile only
  if(window.matchMedia('(max-width: 991px)').matches) {
    const psNavbar = new PerfectScrollbar('#navbarMenu', {
      suppressScrollX: true
    });
  }

  // Showing sub-menu of active menu on navbar when mobile
  function showNavbarActiveSub() {
    if(window.matchMedia('(max-width: 991px)').matches) {
      $('#navbarMenu .active').addClass('show');
    } else {
      $('#navbarMenu .active').removeClass('show');
    }
  }

  showNavbarActiveSub()
  $(window).resize(function(){
    showNavbarActiveSub()
  })

  // Initialize backdrop for overlay purpose
  $('body').append('<div class="backdrop"></div>');


  // Showing sub menu of navbar menu while hiding other siblings
  $('.navbar-menu .with-sub .nav-link').on('click', function(e){
    e.preventDefault();
    $(this).parent().toggleClass('show');
    $(this).parent().siblings().removeClass('show');

    if(window.matchMedia('(max-width: 991px)').matches) {
      psNavbar.update();
    }
  })

  // Closing dropdown menu of navbar menu
  $(document).on('click touchstart', function(e){
    e.stopPropagation();

    // closing nav sub menu of header when clicking outside of it
    if(window.matchMedia('(min-width: 992px)').matches) {
      var navTarg = $(e.target).closest('.navbar-menu .nav-item').length;
      if(!navTarg) {
        $('.navbar-header .show').removeClass('show');
      }
    }
  })

  $('#mainMenuClose').on('click', function(e){
    e.preventDefault();
    $('body').removeClass('navbar-nav-show');
  });

  $('#sidebarMenuOpen').on('click', function(e){
    e.preventDefault();
    $('body').addClass('sidebar-show');
  })

  // Navbar Search
  $('#navbarSearch').on('click', function(e){
    e.preventDefault();
    $('.navbar-search').addClass('visible');
    $('.backdrop').addClass('show');
  })

  $('#navbarSearchClose').on('click', function(e){
    e.preventDefault();
    $('.navbar-search').removeClass('visible');
    $('.backdrop').removeClass('show');
  })



  ////////// SIDEBAR //////////

  // Initialize PerfectScrollbar for sidebar menu
  if($('#sidebarMenu').length) {
    const psSidebar = new PerfectScrollbar('#sidebarMenu', {
      suppressScrollX: true
    });


    // Showing sub menu in sidebar
    $('.sidebar-nav .with-sub').on('click', function(e){
      e.preventDefault();
      $(this).parent().toggleClass('show');

      psSidebar.update();
    })
  }


  $('#mainMenuOpen').on('click touchstart', function(e){
    e.preventDefault();
    $('body').addClass('navbar-nav-show');
  })

  $('#sidebarMenuClose').on('click', function(e){
    e.preventDefault();
    $('body').removeClass('sidebar-show');
  })

  // hide sidebar when clicking outside of it
  $(document).on('click touchstart', function(e){
    e.stopPropagation();

    // closing of sidebar menu when clicking outside of it
    if(!$(e.target).closest('.burger-menu').length) {
      var sb = $(e.target).closest('.sidebar').length;
      var nb = $(e.target).closest('.navbar-menu-wrapper').length;
      if(!sb && !nb) {
        if($('body').hasClass('navbar-nav-show')) {
          $('body').removeClass('navbar-nav-show');
        } else {
          $('body').removeClass('sidebar-show');
        }
      }
    }
  });

})

$(function(){
  'use strict'

  new PerfectScrollbar('.filemgr-sidebar-body', {
    suppressScrollX: true
  });

  new PerfectScrollbar('.filemgr-content-body', {
    suppressScrollX: true
  });

  $('#filemgrMenu').on('click', function(e){
    e.preventDefault();

    $('body').addClass('filemgr-sidebar-show');

    $(this).addClass('d-none');
    $('#mainMenuOpen').removeClass('d-none');
  });

  $(document).on('click touchstart', function(e){
    e.stopPropagation();

    // closing of sidebar menu when clicking outside of it
    if(!$(e.target).closest('.burger-menu').length) {
      var sb = $(e.target).closest('.filemgr-sidebar').length;
      if(!sb) {
        $('body').removeClass('filemgr-sidebar-show');

        $('#filemgrMenu').removeClass('d-none');
        $('#mainMenuOpen').addClass('d-none');
      }
    }
  });


  $('.important').on('click', function(e){
    e.preventDefault();

    var parent = $(this).closest('.card-file');
    var important = parent.find('.marker-icon');

    if(!important.length) {
      $(this).closest('.card-file').append('<div class="marker-icon marker-warning pos-absolute t--1 l--1"><i data-feather="star"></i></div>');

      $(this).html('<i data-feather="star"></i> Unmark as Important');

    } else {
      important.remove();

      $(this).html('<i data-feather="star"></i> Mark as Important');
    }

    feather.replace();
  })

  $('.download').on('click', function(e){
    e.preventDefault();

    $('#toast').toast('show');
  })

})

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

