(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/hnice-image-gallery.default', ($scope) => {
            let settings = $scope.data('settings');
            let $iso = $scope.find('.isotope-grid');
            if ($iso) {
                let currentIsotope = $iso.isotope({
                    filter: '*',
                    masonry: {
                        columnWidth: '.grid__item',
                        gutter: settings.column_spacing.size,
                    }
                });
                $scope.find('.elementor-galerry__filters li').on('click', function () {
                    $(this).parents('ul.elementor-galerry__filters').find('li.elementor-galerry__filter').removeClass('elementor-active');
                    $(this).addClass('elementor-active');
                    let selector = $(this).attr('data-filter');
                    currentIsotope.isotope({
                        filter: selector,
                        masonry: {
                            columnWidth: '.grid__item',
                            gutter: settings.column_spacing.size,
                        }
                    });
                });
            }
        });
    });
})(jQuery);

