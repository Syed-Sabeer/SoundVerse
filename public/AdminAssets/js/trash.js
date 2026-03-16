// Delete Quantity Item JS

(function () {
  const InboxData = document.querySelectorAll(".inbox-data");
  InboxData?.forEach((el) => {
    const deleteIcon = el.querySelector(".trash-3");
    deleteIcon.addEventListener("click", function () {
      this.closest(".inbox-data").style.display = "none";
    });
  });
})();
