var waypts = [];

function initMap() {
  var directionsService = new google.maps.DirectionsService();

  var directionsDisplay = new google.maps.DirectionsRenderer({
    polylineOptions: {
      strokeColor: "#2c82c9"
    }
  });

  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 5,
    center: { lat: parseInt(__lat), lng: parseInt(__lng) }
  });

  directionsDisplay.setMap(map);

  document.getElementById("preview").addEventListener("click", function() {
    calculateAndDisplayRoute(directionsService, directionsDisplay);
  });
}

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
  var checkboxArray = document.getElementById("waypoints");
  for (var i = 0; i < checkboxArray.length; i++) {
    if (checkboxArray.options[i].selected) {
      waypts.push({
        location: checkboxArray[i].value,
        stopover: true
      });
    }
  }

  directionsService.route(
    {
      origin: document.getElementById("start").value,
      destination: document.getElementById("end").value,
      waypoints: waypts,
      optimizeWaypoints: true,
      travelMode: "DRIVING"
    },
    function(response, status) {
      if (status === "OK") {
        directionsDisplay.setDirections(response);
        var route = response.routes[0];
        var summaryPanel = document.getElementById("directions-panel");
        summaryPanel.innerHTML = "";
        // For each route, display summary information.
        for (var i = 0; i < route.legs.length; i++) {
          var routeSegment = i + 1;
          summaryPanel.innerHTML +=
            "<b>Route Segment: " + routeSegment + "</b><br>";
          summaryPanel.innerHTML += route.legs[i].start_address + " to ";
          summaryPanel.innerHTML += route.legs[i].end_address + "<br>";
          summaryPanel.innerHTML += route.legs[i].distance.text + "<br><br>";
        }
      } else {
        window.alert(
          "Please specificy Start and Ending Position : ERROR  " + status
        );
      }
    }
  );
}

var _bus;
var _start;
var _end;

$("select.bus_id").change(function() {
  _bus = $(this)
    .children("option:selected")
    .val();
});

$("select.start").change(function() {
  _start = $(this)
    .children("option:selected")
    .val();
});

$("select.end").change(function() {
  _end = $(this)
    .children("option:selected")
    .val();
});

$("#clear").click(function() {
  location.reload();
});

function insertRouteData(waypoint, start, end, stop_name, codename) {
  $.ajax({
    url: "../ajax/createRoute.php",
    type: "POST",
    data: jQuery.param({
      stop: waypoint,
      start: start,
      end: end,
      name: stop_name,
      codename: codename
    }),
    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    success: function(response) {
      location.reload();
    },
    error: function() {
      console.log("error");
    }
  });
}

document.getElementById("submit").addEventListener("click", function() {
  var _name = $("#route_name").val();
  var _code = $("#route_codename").val();

  insertRouteData(waypts, _start, _end, _name, _code);
});
