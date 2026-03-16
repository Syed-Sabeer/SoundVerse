// Animated form JS

$(document).ready(function () {
  $("form").on("blur", "input", checkForValidations);
  $("form").on("focus", "input", removeValidationClass);
});

function checkForValidations(evt) {
  var $obj = $(this);
  if ($obj.hasClass("required")) {
    if (emptyField($obj)) {
      InputShake($obj);
    } else {
      $obj.removeClass().addClass("success form-control");
    }
  }
  if ($obj.hasClass("email")) {
    if (!emptyField($obj)) {
      validaEmail($obj);
    }
  }
  if ($obj.hasClass("confirmation")) {
    if (!emptyField($obj)) {
      matchFields($obj);
    }
  }
}

function removeValidationClass(evt) {
  $(this).removeClass("error animated input-shake");
}

function emptyField($objects1) {
  return $objects1.val() == "" ? true : false;
}

function InputShake($objects1) {
  $objects1.removeClass("success").addClass("error animated input-shake");
}

function validaEmail($objects1) {
  var er = RegExp(/^[A-Za-z0-9_\-\.]+@[A-Za-z0-9_\-\.]{2,}\.[A-Za-z0-9]{2,}(\.[A-Za-z0-9])?/);
  if (er.test($objects1.val()) == false) {
    InputShake($objects1);
  }
}

function matchFields($objects1) {
  var parentID = "#" + $objects1.attr("ID").replace("2", "");
  if ($(parentID).val() != $objects1.val()) {
    InputShake($objects1);
  }
}
