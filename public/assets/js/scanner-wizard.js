$('#scannerUploader').steps({
          headerTag: 'h3',
          bodyTag: 'section',
          autoFocus: true,
          titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
          onInit : function(){
            $("#scannerUploader .actions a[href='#next']").parent().attr('aria-disabled',true).addClass('disabled');
          },
          onStepChanging: function (event, currentIndex, newIndex) { 
            // Validate the first step by checking if there is an image
            if(currentIndex == 0){
                if($(".th_img").length == 0){
                     return false;
                }
            }
            return true; 
          },
          onFinishing: function (event, currentIndex) { 
            if($("#scanner-form").valid()) {
                as.btn.loading($("#scannerUploader .actions a[href='#finish']"));
                return true; 
            }
            return false;
         }, 
          onFinished: function (event, currentIndex) {
            $("#btn-upload").click();
           },
               /* Transition Effects */
        transitionEffect: $.fn.steps.transitionEffect.none,
        transitionEffectSpeed: 600,
            /* Labels */
        labels: {
            cancel: "Annuler",
            current: "current step:",
            pagination: "Pagination",
            finish: "Terminer",
            next: "Suivant",
            previous: "Précédent",
            loading: "Chargement ..."
        }
});
