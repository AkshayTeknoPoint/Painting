require(['jquery', 'jquery/ui', 'slick'], function($) {
    $(document).ready(function() {
        $(".regular").slick({
                dots: true,
                infinite: true,
                autoplay: true, /* this is the new line */
                autoplaySpeed: 2000,
                slidesToShow: 1,
                slidesToScroll: 1
        });
    });
});