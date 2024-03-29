var base_url = $('#baseurl').val();

// remap jQuery to $
(function($){

 

    })(this.jQuery);



// usage: log('inside coolFunc',this,arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function(){
    log.history = log.history || [];   // store logs to an array for reference
    log.history.push(arguments);
    if(this.console){
        console.log( Array.prototype.slice.call(arguments) );
    }
};

// inline input titles
$(function()  {
    $('input[title]').each(function() {
        if($(this).val() === '') {
            $(this).val($(this).attr('title')); 
        }
  
        $(this).focus(function() {
            if($(this).val() === $(this).attr('title')) {
                $(this).val('').addClass('focused'); 
            }
        });
  
        $(this).blur(function() {
            if($(this).val() === '') {
                $(this).val($(this).attr('title')).removeClass('focused'); 
            }
        });
    });
});

// catch all document.write() calls
(function(doc){
    var write = doc.write;
    doc.write = function(q){ 
        log('document.write(): ',arguments); 
        if (/docwriteregexwhitelist/.test(q)) write.apply(doc,arguments);  
    };
})(document);

$(document).ready(function(){
 
       $('#down_products').mouseenter(function() {
            var submenu = $('#products_mega');
         
                submenu.show('fast');
               var submenu_active = true;
           
        });
        var submenu_active = false;
         
        $('#products_mega').mouseenter(function() {
            submenu_active = true;
        });
         
          $('#down_products').mouseenter(function() {
            submenu_active = true;
        });
        
          $('#down_products').mouseleave(function() {
          
            submenu_active = false;
            
             setTimeout(function() { if (submenu_active === false) $('#products_mega').hide('slow'); }, 400);
        });
         
        $('#products_mega').mouseleave(function() {
          submenu_active = false;
         
             setTimeout(function() { if (submenu_active === false) $('#products_mega').hide('slow'); }, 400);       
             
        });
     
});




$(document).ready(function(){
var megawidth = $('.megawidth').attr('id');
 $('#products_mega').css('width', megawidth);
$('.mega_item').hover(function() {
$(this).css('background', '#abbdfe');
});

$('.mega_item').mouseleave(function() {
$(this).css('background', 'transparent');
});

});


$(document).ready(function(){


$('.menu_list_item').hover(function() {
$(this).find('li').css('background', '#abbdfe');
});

$('.menu_list_item').mouseleave(function() {
$(this).css('background', 'transparent');
});

});


//wymeditor
jQuery(function() {
    jQuery('.wymeditor').wymeditor();
});






/**
 * --------------------------------------------------------------------
 * jQuery-Plugin "pngFix"
 * Version: 1.2, 09.03.2009
 * by Andreas Eberhard, andreas.eberhard@gmail.com
 *                      http://jquery.andreaseberhard.de/
 *
 * Copyright (c) 2007 Andreas Eberhard
 * Licensed under GPL (http://www.opensource.org/licenses/gpl-license.php)
 *
 * Changelog:
 *    09.03.2009 Version 1.2
 *    - Update for jQuery 1.3.x, removed @ from selectors
 *    11.09.2007 Version 1.1
 *    - removed noConflict
 *    - added png-support for input type=image
 *    - 01.08.2007 CSS background-image support extension added by Scott Jehl, scott@filamentgroup.com, http://www.filamentgroup.com
 *    31.05.2007 initial Version 1.0
 * --------------------------------------------------------------------
 * @example $(function(){$(document).pngFix();});
 * @desc Fixes all PNG's in the document on document.ready
 *
 * jQuery(function(){jQuery(document).pngFix();});
 * @desc Fixes all PNG's in the document on document.ready when using noConflict
 *
 * @example $(function(){$('div.examples').pngFix();});
 * @desc Fixes all PNG's within div with class examples
 *
 * @example $(function(){$('div.examples').pngFix( { blankgif:'ext.gif' } );});
 * @desc Fixes all PNG's within div with class examples, provides blank gif for input with png
 * --------------------------------------------------------------------
 */

(function($) {

    jQuery.fn.pngFix = function(settings) {

        // Settings
        settings = jQuery.extend({
            blankgif: 'blank.gif'
        }, settings);

        var ie55 = (navigator.appName == "Microsoft Internet Explorer" && parseInt(navigator.appVersion) == 4 && navigator.appVersion.indexOf("MSIE 5.5") != -1);
        var ie6 = (navigator.appName == "Microsoft Internet Explorer" && parseInt(navigator.appVersion) == 4 && navigator.appVersion.indexOf("MSIE 6.0") != -1);

        if (jQuery.browser.msie && (ie55 || ie6)) {

            //fix images with png-source
            jQuery(this).find("img[src$=.png]").each(function() {

                jQuery(this).attr('width',jQuery(this).width());
                jQuery(this).attr('height',jQuery(this).height());

                var prevStyle = '';
                var strNewHTML = '';
                var imgId = (jQuery(this).attr('id')) ? 'id="' + jQuery(this).attr('id') + '" ' : '';
                var imgClass = (jQuery(this).attr('class')) ? 'class="' + jQuery(this).attr('class') + '" ' : '';
                var imgTitle = (jQuery(this).attr('title')) ? 'title="' + jQuery(this).attr('title') + '" ' : '';
                var imgAlt = (jQuery(this).attr('alt')) ? 'alt="' + jQuery(this).attr('alt') + '" ' : '';
                var imgAlign = (jQuery(this).attr('align')) ? 'float:' + jQuery(this).attr('align') + ';' : '';
                var imgHand = (jQuery(this).parent().attr('href')) ? 'cursor:hand;' : '';
                if (this.style.border) {
                    prevStyle += 'border:'+this.style.border+';';
                    this.style.border = '';
                }
                if (this.style.padding) {
                    prevStyle += 'padding:'+this.style.padding+';';
                    this.style.padding = '';
                }
                if (this.style.margin) {
                    prevStyle += 'margin:'+this.style.margin+';';
                    this.style.margin = '';
                }
                var imgStyle = (this.style.cssText);

                strNewHTML += '<span '+imgId+imgClass+imgTitle+imgAlt;
                strNewHTML += 'style="position:relative;white-space:pre-line;display:inline-block;background:transparent;'+imgAlign+imgHand;
                strNewHTML += 'width:' + jQuery(this).width() + 'px;' + 'height:' + jQuery(this).height() + 'px;';
                strNewHTML += 'filter:progid:DXImageTransform.Microsoft.AlphaImageLoader' + '(src=\'' + jQuery(this).attr('src') + '\', sizingMethod=\'scale\');';
                strNewHTML += imgStyle+'"></span>';
                if (prevStyle != ''){
                    strNewHTML = '<span style="position:relative;display:inline-block;'+prevStyle+imgHand+'width:' + jQuery(this).width() + 'px;' + 'height:' + jQuery(this).height() + 'px;'+'">' + strNewHTML + '</span>';
                }

                jQuery(this).hide();
                jQuery(this).after(strNewHTML);

            });

            // fix css background pngs
            jQuery(this).find("*").each(function(){
                var bgIMG = jQuery(this).css('background-image');
                if(bgIMG.indexOf(".png")!=-1){
                    var iebg = bgIMG.split('url("')[1].split('")')[0];
                    jQuery(this).css('background-image', 'none');
                    jQuery(this).get(0).runtimeStyle.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + iebg + "',sizingMethod='scale')";
                }
            });
		
            //fix input with png-source
            jQuery(this).find("input[src$=.png]").each(function() {
                var bgIMG = jQuery(this).attr('src');
                jQuery(this).get(0).runtimeStyle.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader' + '(src=\'' + bgIMG + '\', sizingMethod=\'scale\');';
                jQuery(this).attr('src', settings.blankgif)
            });
	
        }
	
        return jQuery;

    };




})(jQuery);


        



function initMenus() {
    $('ul.catmenu ul').hide();
    $.each($('ul.catmenu'), function(){
        $('#' + this.id + '.expandfirst ul.current').show();
    });
    $('ul.catmenu li a').click(
        function() {
            var checkElement = $(this).next();
            var parent = this.parentNode.parentNode.id;

            if($('#' + parent).hasClass('noaccordion')) {
                $(this).next().slideToggle('normal');
                return false;
            }
            if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                if($('#' + parent).hasClass('collapsible')) {
                    $('#' + parent + ' ul:visible').slideUp('normal');
                }
                return false;
            }
            if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                $('#' + parent + ' ul:visible').slideUp('normal');
                checkElement.slideDown('normal');
                return false;
            }
        }
        );
}



