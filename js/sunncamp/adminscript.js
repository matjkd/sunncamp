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