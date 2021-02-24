var StaxSlider = StaxSlider || {};

(function ($) {

    // USE STRICT
    "use strict";

    StaxSlider.fn = {
        init: function () {
            StaxSlider.fn.initSlider();
        },

        initSlider: function () {
            var container = $('.swiper-container');

            var data = {
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            };

            if (container.data('autoplay')) {
                data.autoplay = {
                    delay: container.data('autoplay-speed')
                };
            }

            var mySwiper = new Swiper('.swiper-container', data);
        }
    };

    StaxSlider.fn.init();

})(jQuery);
