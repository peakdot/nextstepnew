var map;
var markers = [];
var newMarkers = [];
var filtermarkers = [];
var jobs = [];
var markerIcon = "imgs/markerf.png";
var infoWindow;

function map_initialize(userType = 0) {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: {lat: 47.9166, lng: 106.9175},

        zoomControl: false,
        mapTypeControl: false,
        scaleControl: false,
        streetViewControl: true,
        rotateControl: false,
        fullscreenControl: false,
        clickableIcons: false


    });


    infoWindow = new google.maps.InfoWindow;

    google.maps.event.addListener(infoWindow, 'domready', function() {
        // Reference to the DIV which receives the contents of the infowindow using jQuery
        var iwOuter = $('.gm-style-iw');

        /* The DIV we want to change is above the .gm-style-iw DIV.
        * So, we use jQuery and create a iwBackground variable,
        * and took advantage of the existing reference to .gm-style-iw for the previous DIV with .prev().
        */
        var iwBackground = iwOuter.prev();

        // Remove the background shadow DIV
        iwBackground.children(':nth-child(2)').css({'display' : 'none'});

        // Remove the white background DIV
        iwBackground.children(':nth-child(4)').css({'display' : 'none'});

        // Changes the desired tail shadow color.
        iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': '0px 1px 6px black', 'z-index' : '1'});
    });

    clickListener = map.addListener('click', function(e) {
        infoWindow.close();
    });

    loadMarkers(jobs, userType);
}

function loadMarkers(job_big_array, userType){
    var len = job_big_array.length;

    for(var i = 0; i < len; i++) {
        var html_part1 = '<div class="mapiw"><b><div class="mapiwtext">' +job_big_array[i][1] + '<br/>' + job_big_array[i][2] + '<br/>' + job_big_array[i][4] + ' ' + job_big_array[i][5] + '₮<br/>'+job_big_array[i][8] + '<br/><b/></div>';

        if(userType == 0) {
            var html_part2 ='<a href="#!" onclick="loadJob(' + job_big_array[i][0] + ');" class="button flat modal-trigger">Дэлгэрэнгүй</a><a href="#!" onclick="saveJob(' + job_big_array[i][0] + ');" class="button flat">Хадгалах</a></div>';
        } else if(userType == 1) {
            var html_part2 ='<a href="#!" onclick="loadJob(' + job_big_array[i][0] + ');" class="button flat modal-trigger">Дэлгэрэнгүй</a><a href="#!" onclick="addJob(' + job_big_array[i][0] + ');" class="button flat">Хадгалах</a></div><a href="#!" onclick="removeJob(' + job_big_array[i][0] + ');" class="button flat">Устгах</a></div>';
        }
        var point = new google.maps.LatLng(
            parseFloat(job_big_array[i][6]),
            parseFloat(job_big_array[i][7]));
        var marker = new google.maps.Marker({
            map: map,
            position: point,
            animation: google.maps.Animation.DROP,
            icon: markerIcon
        });
        markers.push(marker);
        bindInfoWindow(marker, map, infoWindow, html_part1 + html_part2);
    }
}

function bindInfoWindow(marker, map, infoWindow, html) {
  google.maps.event.addListener(marker, 'click', function() {
    infoWindow.setContent(html);
    infoWindow.open(map, marker);
});
} 

// Sets the map on all markers in the array.
function setallnewMarkers(map) {
  var len = newMarkers.length;
  for (var i = 0; i < len; i++) {
    newMarkers[i].setMap(map);
}
}

// Sets the map on all markers in the array.
function setalljobMarkers(map) {
  var len = markers.length;
  for (var i = 0; i < len; i++) {
    markers[i].setMap(map);
}
}

// Adds a marker to the map and push to the array.
function changeMarkerLoc(latLng, map) {
  var len = newMarkers.length;
  var marker = new google.maps.Marker({
    position: latLng,
    map: map,
    animation: google.maps.Animation.DROP,
    icon: markerIcon
}); 
  if(newMarkers[0] != null) {
    newMarkers[0].setMap(null);
}
newMarkers[0] = marker;
}

function showMarker(type){
  switch(type){
    case 'job': {
      setallnewMarkers(null);
      setalljobMarkers(map);
      break;
  }
  case 'new': {
      setallnewMarkers(map);
      setalljobMarkers(null);
      break;
  }
  case 'filter': {
      setallnewMarkers(null);
      setalljobMarkers(null);
      break;
  }
  default: {
      setallnewMarkers(null);
      setalljobMarkers(map);
  }
}
}

function deletenewMarkers() {
  showMarker('job');
  newMarkers = [];
}

var nav = $("nav"),
menufab = $("#floating-add-search");

function prepareTogetLocationFromUser(){
    var doneButton = $("#doneButton");

    $("#map_button").click();

    doneButton.css("visibility","visible");
    doneButton.css("opacity","1");
    nav.css("top", "-56px");
    menufab.css("bottom", "68px");

    showMarker('new');

    doneButton.click(function(){
        getLocationFromUser();
    });

    clickListener = map.addListener('click', function(e) {
        changeMarkerLoc(e.latLng, map);
    });
}

function getLocationFromUser(){
    var doneButton = $("#doneButton");

    doneButton.css("visibility","hidden");
    doneButton.css("opacity","0");
    nav.css("top", "0");
    menufab.css("bottom", "20px");

    showMarker('job');

    var position = newMarkers[0].position;
    lat = position.lat();
    lng = position.lng();

    $("#coordx").attr("value",lat);
    $("#coordy").attr("value",lng);

    document.getElementById("locationNumber").innerHTML = newMarkers.length+" байршил орсон байна.";
    google.maps.event.removeListener(clickListener);
}
