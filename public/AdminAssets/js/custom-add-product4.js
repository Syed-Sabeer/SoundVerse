// Add blog editor JS

(function () {
  // standard editor
  var editor8 = new Quill("#editor8", {
    modules: { toolbar: "#toolbar8" },
    theme: "snow",
    placeholder: "Enter your messages...",
  });
  var editor4 = new Quill("#editor4", {
    modules: { toolbar: "#toolbar4" },
    theme: "snow",
    placeholder: "Enter your messages...",
  });
})();
