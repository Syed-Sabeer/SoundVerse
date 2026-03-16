// Trash Functionality JS

(function () {
  document.addEventListener("DOMContentLoaded", function () {
    const deleteIcons = document.querySelectorAll(".trash-3, .trash-4, .trash-5, .trash-6, .trash-7");

    const alertMessages = {
      "trash-3": "Do you really want to delete the product?",
      "trash-4": "Do you really want to delete the API Key?",
      "trash-5": "Do you really want to delete the Customer Review?",
      "trash-6": "Do you really want to delete the role?",
      "trash-7": "Do you really want to delete the name?",
    };

    deleteIcons.forEach(function (icon) {
      icon.addEventListener("click", function (event) {
        event.preventDefault();

        const productRow = icon.closest("tr");

        let alertMessage = "Do you really want to delete this item?";
        for (const className in alertMessages) {
          if (icon.classList.contains(className)) {
            alertMessage = alertMessages[className];
            break;
          }
        }
        Swal.fire({
          title: "Are you sure?",
          text: alertMessage,
          showCancelButton: true,
          confirmButtonColor: "#16C7F9",
          cancelButtonColor: "#FC4438",
          confirmButtonText: "Yes, delete it!",
          imageUrl: "../assets/images/gif/trash.gif",
          imageWidth: 120,
          imageHeight: 120,
        }).then((result) => {
          if (result.isConfirmed) {
            productRow.remove();
          }
        });
      });
    });
  });
})();
