// Input mask js
(function () {
  // Card number
  var cleave1 = new Cleave("#cleave-card-number", {
    creditCard: true,
    onCreditCardTypeChanged: function (type) {},
  });

  // Date
  var cleave2 = new Cleave("#cleave-date1", {
    date: true,
    delimiter: "-",
    datePattern: ["d", "m", "Y"],
  });

  // Date2
  var cleave3 = new Cleave("#cleave-date2", {
    date: true,
    datePattern: ["m", "y"],
  });

  // Time
  var cleave4 = new Cleave("#cleave-time1", {
    time: true,
    timePattern: ["h", "m", "s"],
  });

  // Time2
  var cleave5 = new Cleave("#cleave-time2", {
    time: true,
    timePattern: ["h", "m"],
  });

  // Number format
  var cleave6 = new Cleave("#cleave-number-format", {
    numeral: true,
  });

  // Prefix
  var cleave7 = new Cleave("#cleave-type-prefix", {
    prefix: "PREFIX",
    delimiter: "-",
    blocks: [6, 4, 4, 4],
    uppercase: true,
  });

  // Delimiter
  var cleave8 = new Cleave("#cleave-type-delimiter", {
    delimiter: "·",
    blocks: [3, 3, 3],
    uppercase: true,
  });

  //Phone number
  var cleave9 = new Cleave("#cleave-phone-number", {
    delimiters: ["(", ")", "-"],
    blocks: [0, 3, 3, 4],
    numericOnly: true,
    uppercase: true,
  });

  //IP Address
  var cleave10 = new Cleave("#cleave-ip-address", {
    delimiters: [".", ".", "."],
    blocks: [3, 3, 2, 2],
    numericOnly: true,
    uppercase: true,
  });
  //Use multiple delimiters
  var cleave11 = new Cleave("#cleave-multiple-delimiter", {
    uppercase: true,
    delimiters: [".", ".", "-"],
    numericOnly: true,
    blocks: [3, 3, 3, 2],
  });

  //Use multiple characters
  var cleave12 = new Cleave("#cleave-multiple-characters", {
    uppercase: true,
    delimiters: [" ", "|", " ", " ", "|", " ", " ", "|", " "],
    blocks: [3, 0, 0, 3, 0, 0, 3, 0, 0, 3, 0],
  });

  // Tailprefix
  new Cleave("#tailprefix", {
    numeral: true,
    blocks: [4, 2],
    prefix: "€",
    tailPrefix: true,
  });
})();
