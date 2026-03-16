// Timer JS

(function () {
  document.addEventListener("readystatechange", (event) => {
    if (event.target.readyState === "complete") {
      var commonTimer = document.getElementsByClassName("timer");
      var countDownDate = new Array();
      for (var i = 0; i < commonTimer.length; i++) {
        countDownDate[i] = new Array();
        countDownDate[i]["el"] = commonTimer[i];
        countDownDate[i]["time"] = new Date(commonTimer[i].getAttribute("data-date")).getTime();
        countDownDate[i]["days"] = 0;
        countDownDate[i]["hours"] = 0;
        countDownDate[i]["seconds"] = 0;
        countDownDate[i]["minutes"] = 0;
      }

      var countDownFunction = setInterval(function () {
        for (var i = 0; i < countDownDate.length; i++) {
          var now = new Date().getTime();
          var distance = countDownDate[i]["time"] - now;
          countDownDate[i]["days"] = Math.floor(distance / (1000 * 60 * 60 * 24));
          countDownDate[i]["hours"] = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          countDownDate[i]["minutes"] = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          countDownDate[i]["seconds"] = Math.floor((distance % (1000 * 60)) / 1000);

          if (distance < 0) {
            countDownDate[i]["el"].querySelector(".days") && (countDownDate[i]["el"].querySelector(".days").innerHTML = 0);
            countDownDate[i]["el"].querySelector(".hours").innerHTML = 0;
            countDownDate[i]["el"].querySelector(".minutes").innerHTML = "00";
            countDownDate[i]["el"].querySelector(".seconds").innerHTML = "00";
          } else {
            countDownDate[i]["el"].querySelector(".days") && (countDownDate[i]["el"].querySelector(".days").innerHTML = countDownDate[i]["days"]);
            countDownDate[i]["el"].querySelector(".hours").innerHTML = countDownDate[i]["hours"];
            countDownDate[i]["el"].querySelector(".minutes").innerHTML = (countDownDate[i]["minutes"] < 10 ? "0" : "") + countDownDate[i]["minutes"];
            countDownDate[i]["el"].querySelector(".seconds").innerHTML = (countDownDate[i]["seconds"] < 10 ? "0" : "") + countDownDate[i]["seconds"];
          }
        }
      }, 1000);
    }
  });
})();
