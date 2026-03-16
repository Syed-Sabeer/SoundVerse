// Password strength JS

let state = false;
let validatePwd = document.getElementById("validatepwd");
let passwordStrength = document.getElementById("password-strength");
let lowUpperCase = document.querySelector(".low-upper-case i");
let number = document.querySelector(".one-number i");
let specialChar = document.querySelector(".one-special-char i");
let eightChar = document.querySelector(".eight-character i");

validatePwd.addEventListener("keyup", function () {
  let pass = document.getElementById("validatepwd").value;
  checkStrength(pass);
});

function toggle() {
  if (state) {
    document.getElementById("validatepwd").setAttribute("type", "password");
    state = false;
  } else {
    document.getElementById("validatepwd").setAttribute("type", "text");
    state = true;
  }
}

function myFunction(show) {
  if (show.classList.contains("fa-eye-slash")) {
    show.classList.remove("fa-eye-slash");
    show.classList.add("fa-eye");
  } else {
    show.classList.add("fa-eye-slash");
    show.classList.remove("fa-eye");
  }
}

function checkStrength(validatePwd) {
  let strength = 0;

  //If password contains both lower and uppercase characters
  if (validatePwd.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
    strength += 1;
    lowUpperCase.classList.remove("fa-circle");
    lowUpperCase.classList.add("fa-check");
  } else {
    lowUpperCase.classList.add("fa-circle");
    lowUpperCase.classList.remove("fa-check");
  }
  //If it has numbers and characters
  if (validatePwd.match(/([0-9])/)) {
    strength += 1;
    number.classList.remove("fa-circle");
    number.classList.add("fa-check");
  } else {
    number.classList.add("fa-circle");
    number.classList.remove("fa-check");
  }
  //If it has one special character
  if (validatePwd.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
    strength += 1;
    specialChar.classList.remove("fa-circle");
    specialChar.classList.add("fa-check");
  } else {
    specialChar.classList.add("fa-circle");
    specialChar.classList.remove("fa-check");
  }
  //If validatePwd is greater than 7
  if (validatePwd.length > 7) {
    strength += 1;
    eightChar.classList.remove("fa-circle");
    eightChar.classList.add("fa-check");
  } else {
    eightChar.classList.add("fa-circle");
    eightChar.classList.remove("fa-check");
  }

  // If value is less than 2
  if (strength < 2) {
    passwordStrength.classList.remove("progress-bar-warning");
    passwordStrength.classList.remove("progress-bar-success");
    passwordStrength.classList.add("progress-bar-danger");
    passwordStrength.style = "width: 10%";
  } else if (strength == 3) {
    passwordStrength.classList.remove("progress-bar-success");
    passwordStrength.classList.remove("progress-bar-danger");
    passwordStrength.classList.add("progress-bar-warning");
    passwordStrength.style = "width: 60%";
  } else if (strength == 4) {
    passwordStrength.classList.remove("progress-bar-warning");
    passwordStrength.classList.remove("progress-bar-danger");
    passwordStrength.classList.add("progress-bar-success");
    passwordStrength.style = "width: 100%";
  }
}
