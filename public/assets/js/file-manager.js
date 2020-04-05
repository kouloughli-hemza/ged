

$(document).ready(function(){
            moment.locale('fr') // returns the new locale, in this case 'de'

            // Instantiate the Bloodhound suggestion engine
            var documents = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('objet','expiditeur','destinataire','num_enrg','num_text','sig_ext','sig_int'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                prefetch: {
                    url: prefetchRoute,
                    filter: function (data) {
                        return $.map(data, function (gedDocument) {
                            return {
                                name: gedDocument
                            };
                        });
                    }
                },
                remote: {
                    url: route +'?term=%QUERY%',
                    wildcard: '%QUERY%'
                },
            });
            // Initialize the Bloodhound suggestion engine
             documents.initialize();
            // Instantiate the Typeahead UI
            $('.find-document').typeahead(null, {
                source: documents.ttAdapter(),
                templates: {
                    empty: ['<div class="list-group search-results-dropdown"><div class="list-group-item autocomplete-empty"><img width="90px" style="display: block;margin:auto" src="'+emptySearchImage+'"><div><h6 class="tx-center mg-t-20">'+noResutFound+'</h6></div></div></div>'],
                    header: ['<div class="list-group search-results-dropdown">'],
                    suggestion: function (data) {
                        return '<a href="javascript:void(0);" class="list-group-item card-events"><ul class="list-unstyled media-list mg-b-0">    <li class="media">\n' +
                            '        <div class="media-left">\n' +
                            '            <label>'+moment(data.created_at).format("MMM")+'</label>\n' +
                            '            <p>'+moment(data.created_at).format("DD")+'</p>\n' +
                            '        </div>\n' +
                            '        <div class="media-body event-panel-primary">\n' +
                            '            <span class="event-time">'+moment(data.date_arrivee).format("DD-MM-YYYY")+'</span>\n' +
                            '            <h6 class="event-title">'+data.objet+'</h6>\n' +
                            '            <p class="event-desc">'+data.expiditeur+'</p>\n' +
                            '        </div>\n' +
                            '    </li></ul></a>';
                    }
                },
                display: function(data) { return data.objet; }
            }).on('typeahead:selected', function(e){
                e.target.form.submit();
            });

            $(".importance").on('click',function(e){
                value = $(this).data('value');
                $('input#importance-filter').val(value);
                $(".search-form").submit();
            });
            $(".find-document").on('search',function(e){
                $(".search-form").submit();
            });

            $(".deleteImportance").on('click',function(e){
                e.stopPropagation();
                $('input#importance-filter').val('');
                $(".search-form").submit();
            });

            $(".order-by").on('click',function(e){
                value = $(this).data('value');
                $('input#orderBy').val(value);
                $(".search-form").submit();
            });


            $(".deleteOrder").on('click',function(e){
                e.stopPropagation();
                $('input#orderBy').val('');
                $(".search-form").submit();
            });

});




