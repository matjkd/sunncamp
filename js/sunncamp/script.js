      
        
//autocomplete categories
$(function() {
    $( "#autocompletecategories" ).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "/datasource/json_categories",
                data: {
                    term: $("#autocompletecategories").val()
                },
                dataType: "json",
                type: "POST",
                success: function(data){
                    response($.map(data, function(item){
                       return {
                           label: item.label,
                           value: item.label
                       } 
                        
                    }));
                }
            });
        },
        minLength: 2
        
    });
});

      
        
//autocomplete options
$(function() {
    $( "#autocompleteoptions" ).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "/datasource/json_options",
                data: {
                    term: $("#autocompleteoptions").val()
                },
                dataType: "json",
                type: "POST",
                success: function(data){
                    response($.map(data, function(item){
                       return {
                           label: item.label,
                           value: item.label
                       } 
                        
                    }));
                }
            });
        },
        minLength: 2
        
    });
});



     