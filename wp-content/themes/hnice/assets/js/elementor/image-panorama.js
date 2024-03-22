(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/hnice-image-panorama.default', ($scope) => {
            var panorama, viewer, container;
            var hnice_panorama = $('.hnice-panorama', $scope),
                data = hnice_panorama.data('settings');
            container = document.querySelector('.hnice-panorama');
            panorama = new PANOLENS.ImagePanorama(data.img);
            viewer = new PANOLENS.Viewer({container: container});
            viewer.add(panorama);
        });
    });
})
(jQuery);