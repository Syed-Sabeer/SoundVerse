//  Change user chat profile
(function () {
  // Get all the li elements
  const chatItems = document.querySelectorAll(".chats-user .common-space");
  const chatTimeDiv = document.querySelector(".chat-time-chat");

  chatItems.forEach((item) => {
    item.addEventListener("click", function () {
      // Remove active class from all li elements
      chatItems.forEach((el) => el.classList.remove("active"));

      // Add active class to the clicked li element
      this.classList.add("active");

      // Get data from the clicked li element
      const imgElement = this.querySelector(".active-profile img");
      const imgSrc = imgElement ? imgElement.src : "";
      const userName = this.querySelector("div span").innerText;
      const containerDiv = this.querySelector("div.active-profile");
      const statusDiv = containerDiv.querySelector("div.status");
      const isWarning = statusDiv.classList.contains("bg-warning");

      // Debugging logs

      // Check if the elements exist before updating them
      const profileImg = chatTimeDiv.querySelector(".active-profile-chat img");
      const userNameSpan = chatTimeDiv.querySelector("div span");
      const messageP = chatTimeDiv.querySelector("div p");
      const uniqueMinutes = Math.floor(Math.random() * 60);
      const uniqueStatus = chatTimeDiv.querySelector("div div.status");

      if (profileImg) {
        profileImg.src = imgSrc;
      }
      if (userNameSpan) {
        userNameSpan.innerText = userName;
      }
      if (messageP) {
        messageP.innerText = isWarning ? `${uniqueMinutes} min ago` : "Online";
      }
      if (uniqueStatus) {
        uniqueStatus.classList.add(isWarning ? "bg-warning" : "bg-success");
      }
    });
  });
})();
