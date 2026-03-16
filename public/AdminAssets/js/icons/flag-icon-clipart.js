// Flag icons JS

(function ($) {
  "use strict";
  $(".icon-lists div").click(function () {
    $(".fa-fa-icon-show-div").show().removeClass("opacity-0");
    var font_class = $(this).children().children("i").attr("class");
    var flagIconGet = '&lt;i class="' + font_class + '"&gt';
    var flagIconGet1 = '<i class="' + font_class + '"></i>';
    //alert(flagIconGet);
    $("#fGet").html(flagIconGet);
    $("#fGet1").html(font_class);
    $("#icon_main").removeClass();
    $("#icon_main").addClass(font_class);
    $("#icon_main").addClass("fa-2x text-white");
    $(".inp-val").val(flagIconGet1);
  });
  $(".close-icon").click(function () {
    $(".icon-hover-bottom").addClass("opacity-0");
    $(".fa-fa-icon-show-div").hide();
    $(".icon-lists").removeClass("m-b-50");
  });
})(jQuery);
function myFunction() {
  var copyText = document.getElementById("input_copy");
  copyText.select();
  document.execCommand("Copy");
}
