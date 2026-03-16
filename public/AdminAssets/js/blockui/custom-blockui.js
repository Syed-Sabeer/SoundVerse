// Blockui JS

(() => {
  "use strict";

  // Block 1 ---------------------------------------

  // Setup the freeze element to be appended
  let freezeHtml = document.createElement("div");
  freezeHtml.classList.add("freeze-ui");

  // Setup style and append it to the head
  let styleDom = document.createElement("style");
  styleDom.innerHTML = `
              @keyframes load {
                  0% { transform:translate3d(-50%, -50%, 0) rotate(0deg); }
                  100% { transform:translate3d(-50%, -50%, 0) rotate(360deg); }
              }

              .freeze-ui { position:absolute; top:0; left:0; width:100%; height:100%; z-index:2; background-color:rgba(255, 255, 255, .8); }
                  .freeze-ui:before { content:attr(data-text); display:block; max-width:125px; position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);color:#343a40; text-align:center; }
                  .freeze-ui:after { content:''; display:block; width:35px; height:35px; border-radius:50%; border-width:2px; border-style:solid; border-color:transparent var(--recent-dashed-border) var(--recent-dashed-border) var(--recent-dashed-border); position:absolute; top:50%; left:50%; animation:load .85s infinite linear; }
          `;
  document.head.appendChild(styleDom);

  /* Freeze function. Can pass options parameter as follows:
          options = {
              selector: '.class-name' -> Choose an element where to limit the freeze or leave empty to freeze the whole body. Make sure the element has position relative or absolute,
              text: 'Magic is happening' -> Choose any text to show or use the default "Loading". Be careful for long text as it will break the design.
          }
      */
  window.FreezeUI = (options = { text: " ", selector: ".block-wrapper" }) => {
    let parent = document.querySelector(options.selector) || document.body;
    freezeHtml.setAttribute("data-text", options.text);
    parent.appendChild(freezeHtml);
  };

  // The unfreeze function. No parameter needed as it will find by itself where the freezing happens and remove it.
  window.UnFreezeUI = () => {
    let element = document.querySelector(".freeze-ui");
    element.parentElement.removeChild(element);
  };

  // Block 2 ---------------------------------------

  // Setup the freeze element to be appended
  let freezeHtml2 = document.createElement("div");
  freezeHtml2.classList.add("freeze-ui1");

  // Setup style and append it to the head
  let styleDom2 = document.createElement("style");
  styleDom2.innerHTML = `
  .freeze-ui1 .freeze-wrapper {
        width: 100px;
        height: 100px;
        -ms-flex: auto;
        flex: auto;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        margin: 0;
        position: absolute;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        overflow: hidden;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
  }
    .freeze-ui1 .freeze-wrapper .nb-spinner{
        width: 30px;
        height: 30px;
        margin: 0;
        background: transparent;
        border-top: 4px solid #ffffff;
        border-right: 4px solid transparent;
        border-radius: 50%;
        -webkit-animation: 1s spin linear infinite;
        animation: 1s spin linear infinite;
    }

          `;
  document.head.appendChild(styleDom2);

  window.FreezeUI1 = (options = { text: "Loading...", selector: ".block-wrapper" }) => {
    let parent = document.querySelector(options.selector) || document.body;
    freezeHtml2.setAttribute("data-text", options.text);
    parent.appendChild(freezeHtml2);

    // Get the element with the class "freeze-ui1"
    let freezeUi1Element = document.querySelector(".freeze-ui1");
    let blockWrapper = document.querySelector(".block-wrapper");

    // Check if the element exists
    if (freezeUi1Element) {
      // Create a new div element with the class "freeze-wrapper"
      let freezeWrapperDiv = document.createElement("div");
      freezeWrapperDiv.classList.add("freeze-wrapper");

      // Create a new div element with the class "nb-spinner"
      let nbSpinnerDiv = document.createElement("div");
      nbSpinnerDiv.classList.add("nb-spinner");

      // Append the "nb-spinner" div inside the "freeze-wrapper" div
      freezeWrapperDiv.appendChild(nbSpinnerDiv);

      // Append the "freeze-wrapper" div inside the element with class "freeze-ui1"
      freezeUi1Element.appendChild(freezeWrapperDiv);

      blockWrapper.classList.add("overlay-bg");
    }
  };

  // The unfreeze function. No parameter needed as it will find by itself where the freezing happens and remove it.
  window.UnFreezeUI1 = () => {
    let element2 = document.querySelector(".freeze-ui1");
    element2.parentElement.removeChild(element2);
    let blockWrapper2 = document.querySelector(".block-wrapper");
    blockWrapper2.classList.remove("overlay-bg");
  };

  // Block 3 ---------------------------------------

  // Setup the freeze element to be appended
  let freezeHtml3 = document.createElement("div");
  freezeHtml3.classList.add("freeze-ui3");

  // Setup style and append it to the head
  let styleDom3 = document.createElement("style");
  styleDom3.innerHTML = `

  @keyframes spin-loader {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
    .freeze-ui3 .freeze-ui-spin {
      width: 100px;
      height: 100px;
      margin: 0;
      position: absolute;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      top: 50%;
      left: 50%;
      transform: translate(-50%,-50%);
    }

    .freeze-ui3 .freeze-ui-spin .spinner-loader{
      border: 6px dotted #ffffff;
      border-radius: 50%;
      animation: 1s spin-loader linear infinite;
      display: inline-block;
      width: 30px;
      height: 30px;
      vertical-align: middle;
      pointer-events: none;
    } 
     `;
  document.head.appendChild(styleDom3);

  window.FreezeUI3 = (options = { text: "", selector: ".block-wrapper" }) => {
    let parent3 = document.querySelector(options.selector) || document.body;
    freezeHtml3.setAttribute("data-text", options.text);
    parent3.appendChild(freezeHtml3);

    // Get the element with the class "freeze-ui1"
    let freezeUi1Element3 = document.querySelector(".freeze-ui3");
    let blockWrapper3 = document.querySelector(".block-wrapper");

    if (freezeUi1Element3) {
      let freezeWrapperDiv3 = document.createElement("div");
      freezeWrapperDiv3.classList.add("freeze-ui-spin");

      // Create a new div element with the class "nb-spinner"
      let nbSpinnerDiv3 = document.createElement("div");
      nbSpinnerDiv3.classList.add("spinner-loader");

      freezeWrapperDiv3.appendChild(nbSpinnerDiv3);

      freezeUi1Element3.appendChild(freezeWrapperDiv3);

      blockWrapper3.classList.add("overlay-bg");
    }
  };

  // The unfreeze function. No parameter needed as it will find by itself where the freezing happens and remove it.
  window.UnFreezeUI3 = () => {
    let element3 = document.querySelector(".freeze-ui3");
    element3.parentElement.removeChild(element3);
    let blockWrapper3 = document.querySelector(".block-wrapper");
    blockWrapper3.classList.remove("overlay-bg");
  };

  // Block 4 ---------------------------------------

  // Setup the freeze element to be appended
  let freezeHtml4 = document.createElement("div");
  freezeHtml4.classList.add("freeze-ui4");

  // Setup style and append it to the head
  let styleDom4 = document.createElement("style");
  styleDom4.innerHTML = `
              @keyframes load {
                  0% { transform:translate3d(-50%, -50%, 0) rotate(0deg); }
                  100% { transform:translate3d(-50%, -50%, 0) rotate(360deg); }
              }

              .freeze-ui4 { position:absolute; top:0; left:0; width:100%; height:100%; z-index:2; background-color:rgba(255, 255, 255, .8); }
                  .freeze-ui4:before { content:attr(data-text); display:block; max-width:125px; position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);color:#343a40; text-align:center; }
                  .freeze-ui4:after { content:''; display:block; width:35px; height:35px; border-radius:50%; border-width:2px; border-style:solid; border-color:transparent var(--recent-dashed-border) var(--recent-dashed-border) var(--recent-dashed-border); position:absolute; top:50%; left:50%; animation:load .85s infinite linear; }
          `;
  document.head.appendChild(styleDom4);

  /* Freeze function. Can pass options parameter as follows:
          options = {
              selector: '.class-name' -> Choose an element where to limit the freeze or leave empty to freeze the whole body. Make sure the element has position relative or absolute,
              text: 'Magic is happening' -> Choose any text to show or use the default "Loading". Be careful for long text as it will break the design.
          }
      */
  window.FreezeUI4 = (options = { text: "", selector: ".card-block-wrapper" }) => {
    let parent4 = document.querySelector(options.selector) || document.body;
    freezeHtml4.setAttribute("data-text", options.text);
    parent4.appendChild(freezeHtml4);
  };

  // The unfreeze function. No parameter needed as it will find by itself where the freezing happens and remove it.
  window.UnFreezeUI4 = () => {
    let element4 = document.querySelector(".freeze-ui4");
    element4.parentElement.removeChild(element4);
  };

  // Block 5 ---------------------------------------

  // Setup the freeze element to be appended
  let freezeHtml5 = document.createElement("div");
  freezeHtml5.classList.add("freeze-ui5");

  // Setup style and append it to the head
  let styleDom5 = document.createElement("style");
  styleDom5.innerHTML = `
  .freeze-ui5 .freeze-wrapper {
        width: 100px;
        height: 100px;
        -ms-flex: auto;
        flex: auto;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        margin: 0;
        position: absolute;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        overflow: hidden;
        top:50%;
        left:50%;
        transform: translate(-50%,-50%);
  }
    .freeze-ui5 .freeze-wrapper .nb-spinner{
        width: 30px;
        height: 30px;
        margin: 0;
        background: transparent;
        border-top: 4px solid #ffffff;
        border-right: 4px solid transparent;
        border-radius: 50%;
        -webkit-animation: 1s spin linear infinite;
        animation: 1s spin linear infinite;
    }
          `;
  document.head.appendChild(styleDom5);

  window.FreezeUI5 = (options = { text: " ", selector: ".card-block-wrapper" }) => {
    let parent5 = document.querySelector(options.selector) || document.body;
    freezeHtml5.setAttribute("data-text", options.text);
    parent5.appendChild(freezeHtml5);

    // document.getElementsByClassName("block-header").style.backgroundColor = "red";

    let blockHeaders = document.getElementsByClassName("block-header");
    let blockButtons = document.querySelectorAll(".block-btn-4, .block-btn-5, .block-btn-6, .card-img-top2");

    for (let i = 0; i < blockButtons.length; i++) {
      blockButtons[i].style.opacity = "0.4";
    }

    for (let i = 0; i < blockHeaders.length; i++) {
      blockHeaders[i].style.backgroundColor = "transparent";
      blockHeaders[i].style.borderBottomColor = "rgba(82, 82, 108, 0.3)";
    }

    // Get the element with the class "freeze-ui1"
    let freezeUi5Element = document.querySelector(".freeze-ui5");
    let blockWrapper5 = document.querySelector(".card-block-wrapper");

    // Check if the element exists
    if (freezeUi5Element) {
      // Create a new div element with the class "freeze-wrapper"
      let freezeWrapperDiv5 = document.createElement("div");
      freezeWrapperDiv5.classList.add("freeze-wrapper");

      // Create a new div element with the class "nb-spinner"
      let nbSpinnerDiv5 = document.createElement("div");
      nbSpinnerDiv5.classList.add("nb-spinner");

      // Append the "nb-spinner" div inside the "freeze-wrapper" div
      freezeWrapperDiv5.appendChild(nbSpinnerDiv5);

      // Append the "freeze-wrapper" div inside the element with class "freeze-ui1"
      freezeUi5Element.appendChild(freezeWrapperDiv5);

      blockWrapper5.classList.add("overlay-bg");
    }
  };

  // The unfreeze function. No parameter needed as it will find by itself where the freezing happens and remove it.
  window.UnFreezeUI5 = () => {
    let element5 = document.querySelector(".freeze-ui5");
    element5.parentElement.removeChild(element5);

    let blockButtons = document.querySelectorAll(".block-btn-4, .block-btn-5, .block-btn-6");

    for (let i = 0; i < blockButtons.length; i++) {
      blockButtons[i].style.opacity = "1";
    }

    let blockWrapper5 = document.querySelector(".card-block-wrapper");
    blockWrapper5.classList.remove("overlay-bg");
  };

  // Block 6 ---------------------------------------

  // Setup the freeze element to be appended
  let freezeHtml6 = document.createElement("div");
  freezeHtml6.classList.add("freeze-ui6");

  // Setup style and append it to the head
  let styleDom6 = document.createElement("style");
  styleDom6.innerHTML = `
  @keyframes spin-loader {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
    .freeze-ui6 .freeze-ui-spin {
      width: 100px;
      height: 100px;
      margin: 0;
      position: absolute;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      top: 50%;
      left: 50%;
      transform: translate(-50%,-50%);
    }

    .freeze-ui6 .freeze-ui-spin .spinner-loader{
      border: 6px dotted #ffffff;
      border-radius: 50%;
      animation: 1s spin-loader linear infinite;
      display: inline-block;
      width: 30px;
      height: 30px;
      vertical-align: middle;
      pointer-events: none;
    }
          `;
  document.head.appendChild(styleDom6);

  window.FreezeUI6 = (options = { text: "Loading...", selector: ".card-block-wrapper" }) => {
    let parent6 = document.querySelector(options.selector) || document.body;
    freezeHtml6.setAttribute("data-text", options.text);
    parent6.appendChild(freezeHtml6);

    // Get the element with the class "freeze-ui1"
    let freezeUi6Element = document.querySelector(".freeze-ui6");
    let blockWrapper6 = document.querySelector(".card-block-wrapper");

    let blockButtons = document.querySelectorAll(".block-btn-4, .block-btn-5, .block-btn-6");

    for (let i = 0; i < blockButtons.length; i++) {
      blockButtons[i].style.opacity = "0.4";
    }

    // Check if the element exists
    if (freezeUi6Element) {
      // Create a new div element with the class "freeze-wrapper"
      let freezeWrapperDiv6 = document.createElement("div");
      freezeWrapperDiv6.classList.add("freeze-ui-spin");

      // Create a new div element with the class "nb-spinner"
      let nbSpinnerDiv6 = document.createElement("div");
      nbSpinnerDiv6.classList.add("spinner-loader");

      // Append the "nb-spinner" div inside the "freeze-wrapper" div
      freezeWrapperDiv6.appendChild(nbSpinnerDiv6);

      // Append the "freeze-wrapper" div inside the element with class "freeze-ui6"
      freezeUi6Element.appendChild(freezeWrapperDiv6);

      blockWrapper6.classList.add("overlay-bg");
    }
  };

  // The unfreeze function. No parameter needed as it will find by itself where the freezing happens and remove it.
  window.UnFreezeUI6 = () => {
    let element6 = document.querySelector(".freeze-ui6");
    element6.parentElement.removeChild(element6);

    let blockButtons = document.querySelectorAll(".block-btn-4, .block-btn-5, .block-btn-6");

    for (let i = 0; i < blockButtons.length; i++) {
      blockButtons[i].style.opacity = "1";
    }

    let blockWrapper6 = document.querySelector(".card-block-wrapper");
    blockWrapper6.classList.remove("overlay-bg");
  };

  // Block 7 ---------------------------------------

  // Setup the freeze element to be appended
  let freezeHtml7 = document.createElement("div");
  freezeHtml7.classList.add("freeze-ui7");

  // Setup style and append it to the head
  let styleDom7 = document.createElement("style");
  styleDom7.innerHTML = `
               @keyframes load {
                   0% { transform:translate3d(-50%, -50%, 0) rotate(0deg); }
                   100% { transform:translate3d(-50%, -50%, 0) rotate(360deg); }
               }
 
               .freeze-ui7 { position:absolute; top:0; left:0; width:100%; height:100%; z-index:2; background-color:rgba(255, 255, 255, .8); }
                   .freeze-ui7:before { content:attr(data-text); display:block; max-width:125px; position:absolute; top:50%; left:50%; transform:translate(-50%, -50%);color:#343a40; text-align:center; }
                   .freeze-ui7:after { content:''; display:block; width:35px; height:35px; border-radius:50%; border-width:2px; border-style:solid; border-color:transparent var(--recent-dashed-border) var(--recent-dashed-border) var(--recent-dashed-border); position:absolute; top:50%; left:50%; animation:load .85s infinite linear; }
           `;
  document.head.appendChild(styleDom7);

  /* Freeze function. Can pass options parameter as follows:
           options = {
               selector: '.class-name' -> Choose an element where to limit the freeze or leave empty to freeze the whole body. Make sure the element has position relative or absolute,
               text: 'Magic is happening' -> Choose any text to show or use the default "Loading". Be careful for long text as it will break the design.
           }
       */
  window.FreezeUI7 = (options7 = { text: " ", selector: ".card-wrapper" }) => {
    let parent7 = document.querySelector(options7.selector) || document.body;
    freezeHtml7.setAttribute("data-text", options7.text);
    parent7.appendChild(freezeHtml7);
  };

  // The unfreeze function. No parameter needed as it will find by itself where the freezing happens and remove it.
  window.UnFreezeUI7 = () => {
    let element7 = document.querySelector(".freeze-ui7");
    element7.parentElement.removeChild(element7);
  };

  // Block 8 ---------------------------------------

  // Setup the freeze element to be appended
  let freezeHtml8 = document.createElement("div");
  freezeHtml8.classList.add("freeze-ui8");

  // Setup style and append it to the head
  let styleDom8 = document.createElement("style");
  styleDom8.innerHTML = `
    .freeze-ui8 .freeze-wrapper {
          width: 100px;
          height: 100px;
          -ms-flex: auto;
          flex: auto;
          -webkit-box-sizing: border-box;
          box-sizing: border-box;
          margin: 0;
          position: absolute;
          display: -ms-flexbox;
          display: flex;
          -webkit-box-pack: center;
          -ms-flex-pack: center;
          justify-content: center;
          -webkit-box-align: center;
          -ms-flex-align: center;
          align-items: center;
          overflow: hidden;
          top:50%;
          left:50%;
          transform: translate(-50%,-50%);
    }
      .freeze-ui8 .freeze-wrapper .nb-spinner{
          width: 30px;
          height: 30px;
          margin: 0;
          background: transparent;
          border-top: 4px solid #ffffff;
          border-right: 4px solid transparent;
          border-radius: 50%;
          -webkit-animation: 1s spin linear infinite;
          animation: 1s spin linear infinite;
      }
  
            `;
  document.head.appendChild(styleDom8);

  window.FreezeUI8 = (options = { text: "Loading...", selector: ".card-wrapper" }) => {
    let parent = document.querySelector(options.selector) || document.body;
    freezeHtml8.setAttribute("data-text", options.text);
    parent.appendChild(freezeHtml8);

    // Get the element with the class "freeze-ui1"
    let freezeUi8Element = document.querySelector(".freeze-ui8");
    let blockWrapper = document.querySelector(".card-wrapper");

    // Check if the element exists
    if (freezeUi8Element) {
      // Create a new div element with the class "freeze-wrapper"
      let freezeWrapperDiv = document.createElement("div");
      freezeWrapperDiv.classList.add("freeze-wrapper");

      // Create a new div element with the class "nb-spinner"
      let nbSpinnerDiv = document.createElement("div");
      nbSpinnerDiv.classList.add("nb-spinner");

      // Append the "nb-spinner" div inside the "freeze-wrapper" div
      freezeWrapperDiv.appendChild(nbSpinnerDiv);

      // Append the "freeze-wrapper" div inside the element with class "freeze-ui1"
      freezeUi8Element.appendChild(freezeWrapperDiv);

      blockWrapper.classList.add("overlay-bg");
    }
  };

  // The unfreeze function. No parameter needed as it will find by itself where the freezing happens and remove it.
  window.UnFreezeUI8 = () => {
    let element8 = document.querySelector(".freeze-ui8");
    element8.parentElement.removeChild(element8);
    let blockWrapper8 = document.querySelector(".card-wrapper");
    blockWrapper8.classList.remove("overlay-bg");
  };

  // Block 9 ---------------------------------------

  // Setup the freeze element to be appended
  let freezeHtml9 = document.createElement("div");
  freezeHtml9.classList.add("freeze-ui9");

  // Setup style and append it to the head
  let styleDom9 = document.createElement("style");
  styleDom9.innerHTML = `

  @keyframes spin-loader {
    0% {
      transform: rotate(0deg);
    }
    100% {
      transform: rotate(360deg);
    }
  }
    .freeze-ui9 .freeze-ui-spin {
      width: 100px;
      height: 100px;
      margin: 0;
      position: absolute;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      top: 50%;
      left: 50%;
      transform: translate(-50%,-50%);
    }

    .freeze-ui9 .freeze-ui-spin .spinner-loader{
      border: 6px dotted #ffffff;
      border-radius: 50%;
      animation: 1s spin-loader linear infinite;
      display: inline-block;
      width: 30px;
      height: 30px;
      vertical-align: middle;
      pointer-events: none;
    } 
     `;
  document.head.appendChild(styleDom9);

  window.FreezeUI9 = (options = { text: "", selector: ".card-wrapper" }) => {
    let parent9 = document.querySelector(options.selector) || document.body;
    freezeHtml9.setAttribute("data-text", options.text);
    parent9.appendChild(freezeHtml9);

    // Get the element with the class "freeze-ui1"
    let freezeUi1Element9 = document.querySelector(".freeze-ui9");
    let blockWrapper9 = document.querySelector(".card-wrapper");

    if (freezeUi1Element9) {
      let freezeWrapperDiv9 = document.createElement("div");
      freezeWrapperDiv9.classList.add("freeze-ui-spin");

      // Create a new div element with the class "nb-spinner"
      let nbSpinnerDiv9 = document.createElement("div");
      nbSpinnerDiv9.classList.add("spinner-loader");

      freezeWrapperDiv9.appendChild(nbSpinnerDiv9);

      freezeUi1Element9.appendChild(freezeWrapperDiv9);

      blockWrapper9.classList.add("overlay-bg");
    }
  };

  // The unfreeze function. No parameter needed as it will find by itself where the freezing happens and remove it.
  window.UnFreezeUI9 = () => {
    let element9 = document.querySelector(".freeze-ui9");
    element9.parentElement.removeChild(element9);
    let blockWrapper9 = document.querySelector(".card-wrapper");
    blockWrapper9.classList.remove("overlay-bg");
  };
})();
