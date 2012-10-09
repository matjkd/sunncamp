
           //autoplay roundabout
           $(document).ready(function() {
                                        var interval;

                                        $('ul#myRoundabout')
                                                .roundabout({
                                                       minScale: 0.8 // tiny!

                                                })

                                                .hover(
                                                        function() {
                                                                // oh no, it's the cops!
                                                                clearInterval(interval);
                                                        },
                                                        function() {
                                                                // false alarm: PARTY!
                                                                interval = startAutoPlay();
                                                        }
                                                );
                        //unhide the images		
                                         $('.slide_area').css("display", "block");

                                        // let's get this party started
                                        interval = startAutoPlay();
                                });

                                function startAutoPlay() {
                                        return setInterval(function() {
                                                $('ul#myRoundabout').roundabout_animateToNextChild();
                                        }, 8000);
                                }

   
   
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
        