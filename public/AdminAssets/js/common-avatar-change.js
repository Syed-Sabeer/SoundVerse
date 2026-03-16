// Common avatar change JS

var loadFile = function (event) {
  var image = document.getElementById("output");
  image.src = URL.createObjectURL(event.target.files[0]);
};

document.getElementById("cancelButton").addEventListener("click", function () {
  var image = document.getElementById("output");
  image.src = "../assets/images/forms/user2.png"; // Reset to the placeholder image
  document.querySelector('input[type="file"]').value = ""; // Clear the file input
});
