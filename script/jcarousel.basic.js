
(function($) {
    $(function() {
        $('.jcarousel')
                .jcarousel()
                .jcarouselAutoscroll({
                    interval: 3000,
                    target: '+=1',
                    autostart: true
               });
    });
})(jQuery);