var StaxDropdown = StaxDropdown || {};

(function ($) {

    // USE STRICT
    "use strict";

    StaxDropdown.fn = {
        init: function () {
            StaxDropdown.fn.events();
        },
        el:{
            btn: $('.stx-btn-dropdown')
        },

        events: function () {
            this.el.btn.on('click', function () {
                $(this).next().fadeToggle()
            });

        }
    };

    StaxDropdown.fn.init();

})(jQuery);
