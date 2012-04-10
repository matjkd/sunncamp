var base_url = $('#baseurl').val();

$(document).ready(function() {
    $('.frontpage_slideshow').cycle({
        fx: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
        cleartypeNoBg: 'TRUE'
    });
});      


        
//autocomplete categories
$(function() {
    $( "#autocompletecategories" ).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: base_url + "/datasource/json_categories",
                data: {
                    term: $("#autocompletecategories").val()
                },
                dataType: "json",
                type: "POST",
                success: function(data){
                    response($.map(data, function(item){
                        return {
                            label: item.product_category_name,
                            value: item.product_category_name
                        } 
                        
                    }));
                }
            });
        },
        minLength: 1
        
    });
});


      
        
//autocomplete features
$(function() {
    $( "#autocompletefeatures" ).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: base_url + "/datasource/json_features",
                data: {
                    term: $("#autocompletefeatures").val()
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
        minLength: 1
        
    });
});

//autocomplete specs
$(function() {
    $( "#autocompletespecs" ).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: base_url + "/datasource/json_specs",
                data: {
                    term: $("#autocompletespecs").val()
                },
                dataType: "json",
                type: "POST",
                success: function(data){
                    response($.map(data, function(item){
                        return {
                            label: item.spec_desc,
                            value: item.spec_desc
                        } 
                        
                    }));
                }
            });
        },
        minLength: 1
        
    });
});


//autocomplete other features
$(function() {
    $( "#autocompleteotherfeatures" ).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: base_url + "/datasource/json_otherfeatures",
                data: {
                    term: $("#autocompleteotherfeatures").val()
                },
                dataType: "json",
                type: "POST",
                success: function(data){
                    response($.map(data, function(item){
                        return {
                            label: item.other_feature_name,
                            value: item.other_feature_name
                        } 
                        
                    }));
                }
            });
        },
        minLength: 1
        
    });
});

      
        
//autocomplete options
$(function() {
    $( "#autocompleteoptions" ).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: base_url +  "/datasource/json_options",
                data: {
                    term: $("#autocompleteoptions").val()
                },
                dataType: "json",
                type: "POST",
                success: function(data){
                    response($.map(data, function(item){
                        return {
                            label: item.option_category,
                            value: item.option_category
                        } 
                        
                    }));
                }
            });
        },
        minLength: 1
        
    });
});



$(function() {
 	
    $("#specorder").sortable({
        update: function(event,ui)
        {
            $.post(base_url + "/admin/sortspecs", {
                pages: $('#specorder').sortable('serialize')
            } );
        }
    });
    $("#specorder").disableSelection();
	 	
  	
});

$(function() {
 	
    $("#other_feature_order").sortable({
        update: function(event,ui)
        {
            $.post(base_url + "/admin/sortotherfeatures", {
                pages: $('#other_feature_order').sortable('serialize')
            } );
        }
    });
    $("#other_feature_order").disableSelection();
	 	
  	
});


$(function() {
 	
    $("#sortablethumb").sortable({
        update: function(event,ui)
        {
            $.post(base_url + "/admin/ajaxsort", {
                pages: $('#sortablethumb').sortable('serialize')
            } );
        }
    });
    $("#sortablethumb").disableSelection();
	 	
  	
});

function addFeaturetoProduct(product_id) {

    var feature = $('#feature_select').val();
    loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');
  
    if (feature) {
  
        $('#features').append(loadergif);
        $.post(base_url + '/admin/add_product_feature/', {
            product_id: product_id,
            product_feature: feature
        }, function(data) {
            var featuretext = $("#feature_select option:selected").text();
            $('.gifloader').remove();
            var newfeature = "<div class='cattable' id='featurelink_" + data + "'>" + featuretext + "<span  style='width:18px; float:right;' class='ui-icon ui-icon-circle-close spanlink' onclick='deleteFeaturefromProduct(" + product_id +  "," + data + ")' >X</span></div>";
            $('#features').append(newfeature);
    
        });
   
    }

}

function deleteFeaturefromProduct(product_id, feature_id){

    var  loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');
    

    $('#features').append(loadergif);
    $.post(base_url + '/admin/remove_feature/', {
        product_id: product_id,
        feature_link_id: feature_id
    }, function(data) {
       
        $('#featurelink_'+feature_id).remove();
        $('.gifloader').remove();
                       
    });

}

function deleteOtherFeaturefromProduct(other_feature_id){

    var  loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');
    

    $('#other_features').append(loadergif);
    $.post(base_url + 'admin/remove_other_feature/', {
       
        other_feature_link_id: other_feature_id
    }, function(data) {
       
        $('#other_feature_'+other_feature_id).remove();
        $('.gifloader').remove();
                       
    });

}

function deleteManual(id, filename) {

    var  loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');
    var answer = confirm("Are you sure you want to delete this manual?");
    if(answer) {  
        $('#row_' + id).append(loadergif);
        $.post(base_url + '/backend/manuals_admin/delete_manual/', {
            filename: filename,
            manual_id: id
        }, function(data) {
            $('.gifloader').remove();
            $('#row_' + id).remove();
       
                       
        });
    
    } else {
        return false;
    }
}

function deleteTradeReview(id, filename) {

    var  loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');
    var answer = confirm("Are you sure you want to delete this Trade Review?");
    if(answer) {  
        $('#row_' + id).append(loadergif);
        $.post(base_url + '/backend/tradereviews_admin/delete_trade_review/', {
            filename: filename,
            trade_review_id: id
        }, function(data) {
            $('.gifloader').remove();
            $('#row_' + id).remove();
     
                       
        });
    
    } else {
        return false;
    }
}


function addCategorytoProduct(product_id) {
      
      
    var category = $('#autocompletecategories').val(),
    loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');
    
    
    if ( category ) {
        $('#categories').append(loadergif);
        $.post(base_url + '/admin/add_product_category/', {
            product_id: product_id,
            product_category: category
        }, function(data) {
            
            var newcat = "<div class='cattable' id='categorylink_" + data + "'>" + category + "</div>";
            $('#autocompletecategories').val('')
            $('.gifloader').remove();
            $('#categories').append(newcat);
                        
        });
    }
    else
    {
        alert('no category entered');
    }
   
        
}


function deleteCategoryfromProduct(product_id, link_id) {
      
      
    var loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');
    

    $('#categories').append(loadergif);
    $.post(base_url + '/admin/remove_category/', {
        product_id: product_id,
        category_link_id: link_id
    }, function(data) {
       
        $('#categorylink_'+link_id).remove();
        $('.gifloader').remove();
                       
    });
            
   
        
}

function deleteAttribute(option_id) {
    var answer = confirm("Are you sure you want to delete this attribute?");
    if(answer) {  
        var option_category = $('#option_category_' + option_id + '').val(),
        option = $('#option_' + option_id + '').val(),
        stock_level = $('#stock_level_' + option_id + '').val(),
        loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');
       
       
        $.post(base_url + 'admin/delete_attribute/', {
            option_id: option_id,
            stock_level: stock_level,
            option: option,
            option_category: option_category
        }, function(data) {
      
            $('.gifloader').remove();
            $('#row_' + option_id + '').remove();               
        });
        
    } else {
        return false;
    }  
}

function updateAttribute(option_id) {
        
    var option_category = $('#option_category_' + option_id + '').val(),
    option = $('#option_' + option_id + '').val(),
    stock_level = $('#stock_level_' + option_id + '').val(),

    price = $('#price_' + option_id + '').val(),
    loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');
   
      
    $.post(base_url +'admin/edit_attribute/', {
 
        option_id: option_id,
        stock_level: stock_level,
        option: option,
        price: price,
        option_category: option_category
    }, function(data) {
       
       
       
        $('#row_' + option_id + '').css('background','#d23b07');
        
        $('#row_' + option_id + ' input:nth-child(1)').css('color','gray');
        $('#row_' + option_id + ' input:nth-child(2)').css('color','gray');
        $('#row_' + option_id + ' input:nth-child(3)').css('color','gray');
         
         
        $('#row_' + option_id + '').animate({
   
            "backgroundColor": "#ffffff"
        }, 1500 );
       
        $('.gifloader').remove();
                       
    });

}

function addAttributetoProduct(product_id) {

    var option_category = $('#autocompleteoptions').val(),
    option = $('#option').val(),
    stock_level = $('#stock_level').val(),
    price = $('#price').val(),
    loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');
          
    $('#attributes').append(loadergif);
          
    $.post(base_url + 'admin/add_attribute', {
        product_id: product_id,
        option_category: option_category,
        option: option,
        stock_level: stock_level,
        price: price
          
    }, function(data) {
               
                 
        if(data > 0) {   
            var newspec = "<tr id='row_" + data + "'><td><input name='option_category' value='"+ option_category +"'/></td><td><input name='option' value='"+ option +"'/></td><td><input name='stock_level' value='"+ stock_level +"'/></td><td><input name='price' value='"+ price +"'/></td><td><span  style='width:18px; float:right;' class='ui-icon ui-icon-circle-close spanlink' onclick='deleteAttribute(" + data + ")' ></span></td></tr>";
               
            $('#attributes tr:last').after(newspec);  
          
            $('.gifloader').remove();
            $('#autocompleteoptions').val('');
            $('#option').val('');
            $('#stock_level').val('');
            $('#price').val('');
        }
        else
        {
            $('.gifloader').remove();
            alert('Nothing added');
        }      
          
    });
     
}

function addOtherFeaturetoProduct(product_id) {
    var other_feature = $('#autocompleteotherfeatures').val()
   
        
    loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');
          
    $('#other_features').append(loadergif);
           
    $.post( base_url + 'admin/add_other_feature', {
        product_id: product_id,
        other_feature: other_feature
  
          
    }, function(data) {
        
        var newotherfeature = "<li id='other_feature_" + data + "' class='cattable'><div style='float:left;' class='ui-icon ui-icon-arrowthick-2-n-s'></div><strong>" + other_feature + "</strong></li>";
        $('.gifloader').remove();
        $('#other_feature_order li:last').after(newotherfeature);  
        
       
        
    });

}

function addSpectoProduct(product_id) {
    var product_spec = $('#autocompletespecs').val(),
    spec_value = $('#spec_value').val(),
        
    loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');
          
    $('#specs').append(loadergif);
           
    $.post(base_url + 'admin/add_product_spec', {
        product_id: product_id,
        product_spec: product_spec,
        spec_value: spec_value
          
    }, function(data) {
        
        var newspec = "<li id='spec_" + data + "' class='cattable'><div style='float:left;' class='ui-icon ui-icon-arrowthick-2-n-s'></div><strong>" + product_spec + ":</strong> " + spec_value + "</li>";
        $('.gifloader').remove();
        $('#specorder li:last').after(newspec);  
    });

}

function deleteSpecfromProduct(spec_id) {

    var  loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');
 
    $.post(base_url + 'admin/remove_spec/', {
       
        spec_link_id: spec_id
       
    }, function(data) {
    
        $('.gifloader').remove();
        $('#spec_' + spec_id + '').remove()               
    });

}

function raisestock(user_id, option_id) {
 
    var current_stock = $('#stock_' + option_id).html(),
    cart_quantity = $('#cart_' + option_id).html(),
    loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');

     

    if(current_stock > 0) {
    
        $('#stock_' + option_id).append(loadergif);
        var updated_stock =  parseInt(current_stock) - 1;
        var updated_cart = parseInt(cart_quantity) + 1;
      
        
        $.post(base_url + 'usercart/change_stock_level/', {
            user_id: user_id,
            option_id: option_id,
            sum: "minus"
       
        }, function(data) {

            $('.gifloader').remove();
            $('#stock_' + option_id).html(updated_stock);
            $('#cart_' + option_id).html(updated_cart);
              
        });
        
      
    
    }




}

function lowerstock(user_id, option_id) {

    var current_stock = $('#stock_' + option_id).html(),
    cart_quantity = $('#cart_' + option_id).html(),
    loadergif = $('<img class="gifloader" src="' + base_url +'images/load.gif" />');
  
    if(cart_quantity > 0) {
        $('#stock_' + option_id).append(loadergif);
        var updated_stock =  parseInt(current_stock) + 1;
        var updated_cart = parseInt(cart_quantity) - 1;
       
        
        $.post(base_url + 'usercart/change_stock_level/', {
            user_id: user_id,
            option_id: option_id,
            sum: "plus"
       
        }, function(data) {
  
            $('.gifloader').remove();
            $('#stock_' + option_id).html(updated_stock);
            $('#cart_' + option_id).html(updated_cart);
       
              
        });
        
      
    
    }
}






     
