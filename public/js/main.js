$(".logo_navbar").hover(function(){  
    $(this).attr('src','/images/logo2_hover.png');  
    }, function(){  
    $(this).attr('src','/images/logo2.png');  
});  

import Effects from './Effects.js';
const effects = new Effects();
effects.accordion();
$(window).on('scroll', function() {
    if ($(window).scrollTop() > 50) {
        effects.navbar_onScroll_bottom();
    }
    if ($(window).scrollTop() <= 50) {
        effects.navbar_onScroll_top();
    }
});
$('.form_rating').hide();
effects.show_ratingForm();
