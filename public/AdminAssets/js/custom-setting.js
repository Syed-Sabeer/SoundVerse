// Custom settings JS

(function () {
  var editor14 = new Quill("#editor14", {
    modules: { toolbar: "#toolbar14" },
    theme: "snow",
    placeholder: "Enter your messages...",
  });
})();

// Dynamic Form Field
var room = 1;
function delivery_fields() {
  room++;
  var objTo = document.getElementById("delivery_fields");
  var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group removeclass" + room);
  var rdiv = "removeclass" + room;
  divtest.innerHTML =
    '<div class="row g-2"> <div class="col-sm-6"> <input class="form-control" id="baseItemName" type="text" name="baseItemName[]" value="" placeholder="Enter Title"> </div> <div class="col-sm-6"> <input class="form-control" id="basePrice" type="text" name="basePrice[]" value="" placeholder="Enter Description"> </div> <div class="col-12"> <div class="input-group-btn"> <button class="btn btn-danger" onclick="remove_delivery_fields(' +
    room +
    ');" type="button"> Remove</button> </div> </div> <div class="clear"></div> </div>';

  objTo.appendChild(divtest);
}
function remove_delivery_fields(rid) {
  $(".removeclass" + rid).remove();
}

// Multiple Selects
$(function () {
  $("#example1").multiselectsplitter();

  $("#example2").multiselectsplitter({
    selectSize: 7,
    clearOnFirstChange: true,
    groupCounter: true,
  });

  $("#example3").multiselectsplitter({
    groupCounter: true,
    maximumSelected: 2,
  });

  $("#example4").multiselectsplitter({
    groupCounter: true,
    maximumSelected: 3,
    onlySameGroup: true,
  });

  $("#example5").multiselectsplitter({
    size: 6,
    groupCounter: true,
    maximumSelected: 2,
    maximumAlert: function (maximumSelected) {
      alert("You choose " + (maximumSelected + 1) + " options. Are you crazy ?");
    },
    createFirstSelect: function (label, $originalSelect) {
      return '<option class="txt-primary">prefix - ' + label + "</option>";
    },
    createSecondSelect: function (label, $firstSelect) {
      return '<option class="txt-danger"> ??? </option>';
    },
  });
});
