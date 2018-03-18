var last_infowindow;

function getDistanceFromLatLonInKm(lat1,lon1,lat2,lon2) {
	var R = 6371; // Radius of the earth in km
	var dLat = deg2rad(lat2-lat1);  // deg2rad below
	var dLon = deg2rad(lon2-lon1); 
	var a = 
	Math.sin(dLat/2) * Math.sin(dLat/2) +
	Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
	Math.sin(dLon/2) * Math.sin(dLon/2)
	; 
	var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
	var d = R * c; // Distance in km
	return d;
}

function locToLocDistance(loc1, loc2){
	return getDistanceFromLatLonInKm(loc1.lat(), loc1.lng(), loc2.lat(), loc2.lng());
}

function deg2rad(deg) {
	return deg * (Math.PI/180)
}

function createCircle(locations, radius){

	circle = new google.maps.Circle({
		strokeColor: '#20a50e',
		strokeOpacity: 0.8,
		strokeWeight: 2,
		fillColor: '#00ee00',
		fillOpacity: 0.35,
		map: map,
		center: locations,
		radius: radius,
	});
	return circle;
}

function createMarker(location, text, title){
	var marker = new google.maps.Marker({
		position: location,
		map: map,
		title: title
	});

	var infowindow = new google.maps.InfoWindow({
		content: text
	});

	marker.addListener('click', function() {
		if(last_infowindow != null){
			last_infowindow.close();
		}
		infowindow.open(map, marker);
		last_infowindow = infowindow;
	});

	return marker;
}

var interval_id;
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map, routeResult;
var queued_markers = [];
var all_circles = [];
var all_markers = [];


function initialize() {
	directionsDisplay = new google.maps.DirectionsRenderer();
	var bulgaria = new google.maps.LatLng(42.70344,23.2396765);
	var mapOptions = {
		zoom:7,
		center: bulgaria
	}
	map = new google.maps.Map(document.getElementById('map_container'), mapOptions);
	directionsDisplay.setMap(map);
}

function calcRoute() {
	var start = $('#input_startpoint').val();
	var end = $('#input_endpoint').val();
	var radius = $('#input_radius').val();

	if(start.length > 0 && end.length > 0 && radius.length > 0){
		var request = {
			origin: start,
			destination: end,
			travelMode: 'DRIVING'
		};

		clearAllItems();

		directionsService.route(request, function(result, status) {
			if (status == 'OK') {
				routeResult = result;
				directionsDisplay.setMap(map);
				directionsDisplay.setDirections(result);

				drawAllItems();
			}else if(status == "ZERO_RESULTS"){
				$('#show_circles_btn').notify("Не можахме да намерим едната от точките, моля, опитайте да напишете точките по различен начин.");
			}else{
				$('#show_circles_btn').notify("Появи се неочаквана грешка.");
			}
		});
	}else{
		$('#show_circles_btn').notify("Моля, въведете стойности.", 'info');
	}
}

function clearAllItems(){
	json.forEach(function(element) {
		element['displayed'] = false;
	});

	queued_markers = [];

	all_circles.forEach(function(circle){
		if(typeof circle !== "undefined"){
			circle.setMap(null);
		}
	});

	all_markers.forEach(function(marker){
		if(typeof marker !== "undefined"){
			marker.setMap(null);
		}
	});

	if(directionsDisplay != null){
		directionsDisplay.setMap(null);
	}
	
}

function drawAllItems() {
	var points = routeResult['routes'][0]['overview_path'];
	var paragraph = $('#test_p');
	var distance = getDistanceFromLatLonInKm(points[0].lat(), points[0].lng(), points[points.length - 1].lat(), points[points.length - 1].lng());
	var last_drawn, difference;
	var radius = $('#input_radius').val() ;
	radius = parseInt(radius)*1000;

	var i = 0;

	interval_id = setInterval(function(){
		var circle;
		
		if(i >= points.length){
			clearInterval(interval_id);

			var subinterval_id;
			var j = 0;
			subinterval_id = setInterval(function(){
				var marker;
				if(j >= queued_markers.length){
					clearInterval(subinterval_id);
				}else{

					var html = "<div>";
					html += "<h3>"+queued_markers[j]['s_name']+"</h3>";
					html += "<button id="+queued_markers[j]['s_id']+" onclick='visited(this)'>Посетих го</button><br /><img style='width:200px;height:200px;' src='../images/map_images/"+queued_markers[j]['s_filename']+"' title='"+queued_markers[j]['s_name']+"'/>";
					html += "</div>";
					
					marker = createMarker({lat: queued_markers[j]['s_lat'], lng: queued_markers[j]['s_lng']}, html, queued_markers[j]['s_name']);
					all_markers.push(marker);
				}
				j++;
			}, 50);

		}else{
			var locations = points[i];

			if(i == 0){
				//this shows the circle
				circle = createCircle(locations, radius);

				last_drawn = locations;
			}else{

				difference = locToLocDistance(last_drawn, locations)*1000;

				if(difference >= radius){
					circle = createCircle(locations, radius);
					last_drawn = locations;
				}

			}

			//now we need to calculate which markers to show

			json.forEach(function(element) {
				if(element['displayed'] == false){
					var distance = getDistanceFromLatLonInKm(element['s_lat'], element['s_lng'], locations.lat(), locations.lng());

					if(distance < radius/1000){
						element['displayed'] = true;
						queued_markers.push(element);
					}
				}
			});

			all_circles.push(circle);
		}

		i++;
	}, 10);
}

$(function(){
	//tuka
	initialize();

	$('#show_circles_btn').click(function() {
		// tuka sa izpulnq kogat sa klikne ediniq buton
		calcRoute();

		// createMarker({lat: -25.363, lng: 131.044}, "sdf");
	});
	
	
});

function visited(button_ele){
		sight_id  = $(button_ele).attr('id');
		var request = $.ajax({
		  url: "updatevisited.php",
		  method: "POST",
		  data: { id : sight_id,'secure':'9AFG762s602235df058s@15522!8453725017$918167789^670KNB23QUY731446$8755842!59@407$32' },
		  dataType: "html"
		});
		 
		request.done(function( response ) {
		   if(response==1){
			  $(button_ele).after('<b>Посетено</b>');
			  $(button_ele).hide();
		   }
		});

		
	}