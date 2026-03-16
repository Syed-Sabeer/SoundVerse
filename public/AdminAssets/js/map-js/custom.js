// Map JS

(function ($) {
  // Function to build the map with given latitude and longitude
  function buildMap(lat, lon) {
    $("#weathermap").html("<div id='map' style='width: 100%; height: 100%;'></div>");
    var osmUrl = "http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
      osmAttribution = 'Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
      osmLayer = new L.TileLayer(osmUrl, { maxZoom: 18, attribution: osmAttribution });
    var map = new L.Map("map").setView(new L.LatLng(lat, lon), 9);
    map.addLayer(osmLayer);
    var validatorsLayer = new OsmJs.Weather.LeafletLayer({ lang: "en" });
    map.addLayer(validatorsLayer);
  }

  // Set initial map view and layers
  $("#weathermap").html("<div id='map' style='width: 100%; height: 100%;'></div>");
  var DATE_FORMAT = "dd.mm.yy";

  function strToDateUTC(str) {
    var date = $.datepicker.parseDate(DATE_FORMAT, str);
    return new Date(date - date.getTimezoneOffset() * 60 * 1000);
  }

  var map = L.map("map2").setView([60, 50], 3);

  var osm = L.tileLayer("http://{s}.tile.osm.org/{z}/{x}/{y}.png", {
    maxZoom: 18,
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
  }).addTo(map);

  // Ensure L.Hash is loaded before using it
  if (typeof L.Hash === "function") {
    new L.Hash(map);
  } else {
    console.error("L.Hash is not defined. Ensure leaflet-hash library is included.");
  }

  var $date = $("#date");

  var now = new Date();
  var oneDay = 1000 * 60 * 60 * 24,
    startTimestamp = now.getTime() - oneDay + now.getTimezoneOffset() * 60 * 1000,
    startDate = new Date(startTimestamp);

  $date.val($.datepicker.formatDate(DATE_FORMAT, startDate));

  var baseLayers = {};

  for (var id in L.GIBS_LAYERS) {
    baseLayers[id] = new L.GIBSLayer(id, { date: startDate, transparent: true });
  }

  L.control.layers(baseLayers, null, { collapsed: false }).addTo(map);

  baseLayers["MODIS_Aqua_CorrectedReflectance_TrueColor"].addTo(map);

  $(".leaflet-control-layers").scrollTop(10000);

  function alterDate(delta) {
    var date = $.datepicker.parseDate(DATE_FORMAT, $date.val());
    $date.val($.datepicker.formatDate(DATE_FORMAT, new Date(date.valueOf() + delta * oneDay))).change();
  }

  document.getElementById("prev").onclick = alterDate.bind(null, -1);
  document.getElementById("next").onclick = alterDate.bind(null, 1);

  $date.datepicker({ dateFormat: DATE_FORMAT }).change(function () {
    var date = strToDateUTC(this.value);
    for (var l in baseLayers) {
      baseLayers[l].setDate(date);
    }
  });

  map
    .on("click", function () {
      $date.datepicker("hide");
    })
    .on("baselayerchange", function (event) {
      $("#controls").toggle(event.layer.isTemporal());
      $("#transparent-container").toggle(!!event.layer.setTransparent);
    });

  $("#transparent-checkbox").change(function () {
    for (var l in baseLayers) {
      baseLayers[l].setTransparent && baseLayers[l].setTransparent(this.checked);
    }
  });
})(jQuery);
