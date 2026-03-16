// Scrollable JS

(function ($) {
  "use strict";

  var scrollable_custom = {
    init: function () {
      $(".vertical-scroll").perfectScrollbar({
        suppressScrollX: !0,
        wheelPropagation: !0,
      }),
        $(".horizontal-scroll").perfectScrollbar({
          suppressScrollY: !0,
          wheelPropagation: !0,
        }),
        $(".visible-scroll").perfectScrollbar({
          wheelPropagation: !0,
        }),
        $(".scrollbar-margins").perfectScrollbar({
          wheelPropagation: !0,
        });
    },
  };
  scrollable_custom.init();
})(jQuery);
