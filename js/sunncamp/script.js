$(document).ready( function(){	
    $('#lofslidecontent45').lofJSidernews( {
        interval:10000,
        direction:'opacity',
        duration:1000,
        easing:'easeInOutQuad'
    } );						
});

        
   
//Modal dialog increase the default animation speed to exaggerate the effect
$.fx.speeds._default = 500;
$(document).ready(function(){
    $( "#dialog" ).dialog({
        autoOpen: false,
        show: "fade",
        hide: "fade",
        width: 500
    });

    $( "#opener" ).click(function() {
        $( "#dialog" ).dialog( "open" );
        return false;
    });
});
        
     