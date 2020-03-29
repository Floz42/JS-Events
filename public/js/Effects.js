export default class Effects {

    /** @description make an accordion on click to each arrow of deliveries section
    */
    accordion() {
        let arrow = $('.fa-arrow-circle-down');
        for (let i = 0; i < arrow.length; i++) {
            $(arrow[i]).click(function() {
                let nextElmt = $(this).next();
                if (nextElmt.css('display') === 'none') {
                    nextElmt.css('display', 'inherit')
                } else {
                    nextElmt.css('display', 'none')
                }
            })
        }
    }

    /** @description minimize the navbar logo on scroll bottom
    */
    navbar_onScroll_bottom() {
        $('.logo_navbar').css({
            'width': "60px",
            'transition': "1s"
            })
        }

    /** @description add a large logo when user is at the top of website
    */
    navbar_onScroll_top() {
        $('.logo_navbar').css(
            'width', "120px"
        )
    }

    show_ratingForm() {
        let show = false;
        $('.rating_button').click(() => {
            show = (!show) ? true : false;
            if (show) {
                $('.form_rating').show('slow');
                $('#ratings').hide('slow');
            } else {
                $('.form_rating').hide('slow');
                $('#ratings').show('slow');
            }
        })
    };
    

}