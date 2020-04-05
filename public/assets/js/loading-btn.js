/* Adding Helper Function For Loading */ 

function btnLoading (button, text) {
    var oldText = button.text();
    var newText = typeof text == "undefined" ? '' : text;

    var html = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + newText;
    button.data("old-text", oldText)
        .html(html)
        .addClass("disabled")
        .attr('disabled', "disabled");
};

function stopLoading (button) {
    var oldText = button.data('old-text');
    button.text(oldText)
        .removeClass("disabled")
        .removeAttr("disabled");
};


/* End Adding Helper Function For loading */