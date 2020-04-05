as.btn = {};

as.btn.loading = function(button, text) {
    var oldText = button.text();
    var newText = typeof text == "undefined" ? '' : text;

    var html = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> ' + newText;
    button.data("old-text", oldText)
        .html(html)
        .addClass("disabled")
        .attr('disabled', "disabled");
};

as.btn.stopLoading = function (button) {
    var oldText = button.data('old-text');
    button.text(oldText)
        .removeClass("disabled")
        .removeAttr("disabled");
};

