(function ($) {
    "use strict";

    function goNewWin() {
        window.open("https://www.w3schools.com");
    }

    $(window).on('elementor/frontend/init', () => {

        const addHandler = ($element) => {
            elementorFrontend.elementsHandler.addHandler(hniceSwiperBase, {
                $element,
            });

            let VirtualTour = $('.elementor-virtual-tour-wrapper', $element);
            VirtualTour.find('.elementor-virtual-tour-item').each(function (i, obj) {
                let Linlk = $('.elementor-virtual-tour', this).data('link');
                if (Linlk) {
                    $('.elementor-virtual-tour', this).on('click', function () {
                        window.open(Linlk, 'thenewpop', 'scrollbars=yes,width=1200,height=600,status=1,left=45,top=0,');
                    });
                }
            });
        };
        elementorFrontend.hooks.addAction('frontend/element_ready/hnice-virtual-tour.default', addHandler);
    });
})
(jQuery);