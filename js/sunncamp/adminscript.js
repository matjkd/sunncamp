$(document).ready(function() {
    oTable = $('#product_table').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers"
    });
} );

$(function() {
    $( ".sorting ul" ).sortable({
        items: "li:not(.ui-state-default)",
        connectWith: ".connectedSortable"
    }).disableSelection();
    
    $(".sorting ul").droppable({
        drop: function(ev, ui) {
            var $drop = $(this).attr('id');
            var $drag = ui.draggable.attr("id");
         $.post("/backend/category_admin/change_parent", { drag: $drag, drop: $drop } );
       
        }
    });
});

$(function() {
    $('input').each(function() {
        $.data(this, 'default', this.value);
    }).css("color","gray")
    .focus(function() {
        if (!$.data(this, 'edited')) {
          
            $(this).css("color","black");
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