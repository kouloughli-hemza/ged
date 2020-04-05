$("#registrationForm").steps({
    headerTag: 'h3',
    bodyTag: 'section',
    autoFocus: true,
    titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
    transitionEffect: $.fn.steps.transitionEffect.fade,
    transitionEffectSpeed: 300,
    /* Labels */
    labels: {
        cancel: "Annuler",
        current: "current step:",
        pagination: "Pagination",
        finish: registerText,
        next: "Suivant",
        previous: "Précédent",
        loading: "Chargement ..."
    },
    onStepChanging: function (event, currentIndex, newIndex) {

        // Validate the first step by checking if there is an image
        if(currentIndex == 0){


            if($("#registration-form").valid()){
                return true;
            }
            return false;

        }
        return true;
    },
    onFinishing: function (event, currentIndex) {
        if($("#registration-form").valid()){
            as.btn.loading($("#registrationForm .actions a[href='#finish']"));
            return true;
        }

        return false;
    },
    onFinished: function (event, currentIndex) {
        $("#registration-form").submit();
    },
});
