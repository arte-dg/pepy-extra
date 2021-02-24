var ScrollTop = ScrollTop || {};

(function ($) {

    // USE STRICT
    "use strict";

    ScrollTop.fn = {
        init: function () {
            ScrollTop.fn.initButton();
        },

        initButton: function () {
            var btns = $('.stx-scroll-top');

            btns.each(function (index, btn) {
                btn = $(btn);
                var btn_offset = btn.data('offset');

                if (btn_offset === 0) {
                    btn.removeClass('stx-btn-hidden');
                } else {
                    $(document).on('scroll', function () {
                        var scroll = $(this).scrollTop();
                        if (scroll > btn_offset || scroll === btn_offset) {
                            btn.removeClass('stx-btn-hidden');
                        } else {
                            btn.addClass('stx-btn-hidden');
                        }
                    });
                }

                btn.on('click', function (e) {
                    e.preventDefault();

                    var btn = $(this);

                    $('html, body').animate({
                        scrollTop: 0
                    }, btn.data('speed'));
                    return false;
                });
            });
        }
    };

    ScrollTop.fn.init();

})(jQuery);
