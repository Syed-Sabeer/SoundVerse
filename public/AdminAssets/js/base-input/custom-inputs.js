// Custom Input JS

// Autosize Textarea
const MIN_HEIGHT = 20; // Minimum height for the textarea
const LINE_HEIGHT = 20; // Height of one line of text
const PADDING = 12; // Total padding (top + bottom)
const BORDER = 2; // Total border (top + bottom)

function calculateTextareaHeight(value) {
  const lineBreaks = (value.match(/\n/g) || []).length;
  const newHeight = MIN_HEIGHT + lineBreaks * LINE_HEIGHT + PADDING + BORDER;
  return newHeight;
}

const textarea = document.querySelector(".autosize-area");

textarea.addEventListener("keyup", () => {
  const newHeight = calculateTextareaHeight(textarea.value) + "px";
  if (textarea.style.height !== newHeight) {
    textarea.style.height = newHeight;
  }
});

// Dynamic Form Field
var room = 1;
function cart_fields() {
  room++;
  var objTo = document.getElementById("cart_fields");
  var divtest = document.createElement("div");
  divtest.setAttribute("class", "form-group removeclass" + room);
  var rdiv = "removeclass" + room;
  divtest.innerHTML =
    '<div class="g-3 row custom-input"><div class="col-xxl-3 col-sm-6 box-col-6"><div class=form-group><label for=baseItemName>Items</label> <input class=form-control id=baseItemName name=baseItemName[] placeholder="Add Item Name"></div></div><div class="col-xxl-3 col-sm-6 box-col-6"><div class=form-group><label for=basePrice>Price</label> <input class=form-control id=basePrice name=basePrice[] type=number placeholder=500></div></div><div class="col-xxl-3 col-sm-6 box-col-6"><div class=form-group><label for=baseQuantity>Qty</label> <input class=form-control id=baseQuantity name=baseQuantity[] type=number placeholder=1></div></div><div class="col-xxl-3 col-sm-6 box-col-6"><div class=form-group><label for=baseTotalPrice>Total Price</label> <input class=form-control id=baseTotalPrice name=baseTotalPrice[] type=number placeholder="500"></div></div><div class="col-12"><div class=form-group><div class=input-group><div class=input-group-btn><button class="btn btn-danger"onclick="remove_cart_fields(' +
    room +
    ');"type=button>Remove Item</button></div></div></div></div><div class=clear></div></div>';

  objTo.appendChild(divtest);
}
function remove_cart_fields(rid) {
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
