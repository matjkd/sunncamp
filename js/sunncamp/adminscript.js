 var base_url = $('#baseurl').val();
 
$(document).ready(function() {
    oTable = $('#product_table').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
} );

$(document).ready(function() {
    oTable = $('#company_table').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
} );

$(function() {
    $( "input:submit,  button", ".demo" ).button();
		
});


$(function() {
    $( ".sorting ul" ).sortable({
        items: "li:not(.ui-state-default)",
        connectWith: ".connectedSortable"
    }).disableSelection();
    
    $(".sorting ul").droppable({
        drop: function(ev, ui) {
            var $drop = $(this).attr('id');
            var $drag = ui.draggable.attr("id");
            $.post(base_url +"backend/category_admin/change_parent", {
                drag: $drag, 
                drop: $drop
            } );
       
        }
    });
});

$(function() {
    $('input').each(function() {
        $.data(this, 'default', this.value);
    }).css("color","gray")
    .focus(function() {
        if (!$.data(this, 'edited')) {
          
            $(this).css("color","red");
        }
    }).change(function() {
        $.data(this, 'edited', this.value != "");
    }).blur(function() {
        if (!$.data(this, 'edited')) {
            this.value = $.data(this, 'default');
            $(this).css("color","gray");
        }
    });
});

function deleteCompany(company_id) {

    var loadergif = $('<img class="gifloader" src="' + base_url + 'images/load.gif" />');
    var answer = confirm("Are you sure you want to delete this Company (and all its users)?");
    if(answer) {  
        $('#row_' + company_id).append(loadergif);
        $.post(base_url +'user/user_admin/delete_company/', {
            company_id: company_id
     
        }, function(data) {
            $('.gifloader').remove();
            $('#row_' + company_id).remove();
            alert(data);
                       
        });
    
    } else {
        return false;
    }
}


function deleteUser(user_id) {

    var loadergif = $('<img class="gifloader" src="' + base_url + 'images/load.gif" />');
    var answer = confirm("Are you sure you want to delete this User?");
    if(answer) {
        
        $('#row_' + user_id).append(loadergif);
         $.post(base_url + 'user/user_admin/deactivate_user/', {
            user_id: user_id
     
        }, function(data) {
           
       
         
                       
        });
        
          $.post(base_url + 'backend/cart_admin/reset_cart/', {
            user_id: user_id
     
        }, function(data) {
           
            $('#row_' + user_id).remove();
         
                       
        });
    
    }

}

$(function() {
    $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 320,
        width: 350,
        modal: true 
    })

    $( "#create-user" )
    .button()
    .click(function() {
        $( "#dialog-form" ).dialog( "open" );
    });

});

 function deleteProduct(id) {
        var answer = confirm("Are you sure you want to delete this product (including all variations..)?")
        if (answer){
		
        
          
            
            
             $.post(base_url + 'admin/delete_product/', {
           product_id: id 
        }, function(data) {
      
                    
        });
           
        }
        else{
            alert("nothing deleted!")
        }
    }