// MaxLength input JS

(function ($) {
  $("input.basic-maxlength").maxlength({
    alwaysShow: true,
    warningClass: "badge badge-info",
    limitReachedClass: "badge badge-success",
  });

  $("input.threshold-maxlength").maxlength({
    threshold: 20,
    warningClass: "badge badge-warning",
    limitReachedClass: "badge badge-success",
  });

  $("input.show-maxlength").maxlength({
    alwaysShow: true,
    threshold: 10,
    warningClass: "badge badge-success",
    limitReachedClass: "badge badge-danger",
  });

  $("input.custom-maxlength").maxlength({
    alwaysShow: true,
    threshold: 10,
    warningClass: "badge badge-warning",
    limitReachedClass: "badge badge-success",
    preText: "only ",
    postText: " characters left",
  });

  $("textarea.textarea-maxlength").maxlength({
    alwaysShow: true,
    warningClass: "badge badge-warning",
    limitReachedClass: "badge badge-success",
  });

  $("input.topleft-maxlength").maxlength({
    alwaysShow: true,
    placement: "top-left",
    warningClass: "badge badge-primary",
    limitReachedClass: "badge badge-success",
  });
  $("input.topright-maxlength").maxlength({
    alwaysShow: true,
    placement: "top-right",
    warningClass: "badge badge-secondary",
    limitReachedClass: "badge badge-success",
  });
  $("input.bottomright-maxlength").maxlength({
    alwaysShow: true,
    placement: "bottom-right",
    warningClass: "badge badge-warning",
    limitReachedClass: "badge badge-success",
  });
  $("input.bottomleft-maxlength").maxlength({
    alwaysShow: true,
    placement: "bottom-left",
    warningClass: "badge badge-info",
    limitReachedClass: "badge badge-success",
  });
})(jQuery);
