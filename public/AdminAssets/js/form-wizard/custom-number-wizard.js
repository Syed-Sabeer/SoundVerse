// Common numbering wizard
var form = document.getElementById("msform");
var fieldsets = form.querySelectorAll("form");
var currentStep = 0;
var numSteps = 6;

for (var i = 1; i < fieldsets.length; i++) {
  fieldsets[i].style.display = "none";
}

function nextStep() {
  document.getElementById("backbtn").disabled = false;
  currentStep++;
  if (currentStep > numSteps) {
    currentStep = 1;
  }
  var stepper = document.getElementById("stepper1");
  var steps = stepper.getElementsByClassName("step");

  Array.from(steps).forEach((step, index) => {
    let stepNum = index + 1;
    let stepLength = steps.length;
    if (stepNum === currentStep && currentStep < stepLength) {
      addClass(step, "editing");
      fieldsets[currentStep].style.display = "flex";
    } else {
      removeClass(step, "editing");
    }
    if (stepNum <= currentStep && currentStep < stepLength) {
      addClass(step, "done");
      addClass(step, "active");
      removeClass(step, "editing");
      fieldsets[currentStep - 1].style.display = "none";
    } else {
      removeClass(step, "done");
    }
    if (currentStep == stepLength - 1) {
      document.getElementById("nextbtn").textContent = "Finish";
    }
    if (currentStep > stepLength - 1) {
      document.getElementById("nextbtn").textContent = "Finish";
      addClass(step, "done");
      addClass(step, "active");
      removeClass(step, "editing");
      document.getElementById("nextbtn").disabled = true;
    }
  });
}

function backStep() {
  currentStep--;
  var stepper = document.getElementById("stepper1");
  var steps = stepper.getElementsByClassName("step");
  let stepLength = steps.length;
  document.getElementById("nextbtn").textContent = "Next";
  document.getElementById("nextbtn").disabled = false;
  if (currentStep < stepLength - 1) {
    document.getElementById("backbtn").disabled = false;
    fieldsets[currentStep + 1].style.display = "none";
    fieldsets[currentStep].style.display = "flex";
    removeClass(steps[currentStep], "done");
    removeClass(steps[currentStep], "active");
    if (currentStep == 0) {
      document.getElementById("backbtn").disabled = true;
    }
  } else {
    removeClass(steps[currentStep], "done");
    removeClass(steps[currentStep], "active");
  }
}

function hasClass(elem, className) {
  return new RegExp(" " + className + " ").test(" " + elem.className + " ");
}

function addClass(elem, className) {
  if (!hasClass(elem, className)) {
    elem.className += " " + className;
  }
}

function removeClass(elem, className) {
  console.log("elem, className", elem, className);
  var newClass = " " + elem.className.replace(/[\t\r\n]/g, " ") + " ";
  if (hasClass(elem, className)) {
    while (newClass.indexOf(" " + className + " ") >= 0) {
      newClass = newClass.replace(" " + className + " ", " ");
    }
    elem.className = newClass.replace(/^\s+|\s+$/g, "");
  }
  console.log("elem.className", elem.className);
}
