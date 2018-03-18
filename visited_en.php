<?php
include "map/map_php/init.php";
include 'dbconnect.php';
if(!isset($userRow['userName'])){
    header("Location: ".Base_url()."index_en.php");
}

$visited = $db->getUserVisited($userRow['userId']);

?>
    <!DOCTYPE html>
    <html>
    <head>
        <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
        <meta charset="UTF-8" />
        <title>Visit me!</title>
        <link rel="shortcut icon" type="image/png" href="images/logo_title.png"/>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBeRrOffHBETJb81Cf1XLx9gKf8FweGv7E"></script>
        <script src="map/map_js/jquery.min.js" type="text/javascript"></script>
        <script>
            var json_string = '<?php echo str_replace(array('\n','\r'),'',json_encode($visited)) ?>';
            var json = JSON.parse(json_string);

			json.forEach(function(element) {
                element['displayed'] = false;
                element['s_lat'] = parseFloat(element['s_lat']);
                element['s_lng'] = parseFloat(element['s_lng']);
            });
			
			
            var interval_id;
            var directionsDisplay;
            var directionsService = new google.maps.DirectionsService();
            var map, routeResult;
            var queued_markers = [];
            var all_circles = [];
            var all_markers = [];
            var last_infowindow;

            var i = 0;

            console.log(json);

            interval_id = setInterval(function(){
                if(i >= json.length){
                    console.log(i);
                    clearInterval(interval_id);
                }else{
                    var current_sight = json[i];
                    console.log(current_sight);
					
					var html = "<div>";
					html += "<h3>"+current_sight['s_name']+"</h3>";
					html += "<br /><img style='width:200px;height:200px;' src='../images/map_images/"+current_sight['s_filename']+"' title='"+current_sight['s_name']+"'/><br />"+current_sight['source']+"<br />";
					if(current_sight['wikipedia_link'] != ''){
						html += '<a target="_blank" href="'+current_sight['wikipedia_link']+'">Source</a>';
					}
					html += "</div>";
                    marker = createMarker({lat: current_sight['s_lat'], lng: current_sight['s_lng']}, html, current_sight['s_name'], current_sight['is_national']);
                }

                i++;
            }, 10);

            function createMarker(location, text, title, is_national){
                var marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    title: title
                });


                if(is_national==1){
                    marker.setIcon('http://maps.google.com/mapfiles/ms/icons/blue-dot.png');
                }

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

            function initialize() {
                directionsDisplay = new google.maps.DirectionsRenderer();
                var bulgaria = new google.maps.LatLng(42.70344,23.2396765);
                var mapOptions = {
                    zoom:7,
                    center: bulgaria
                };
                map = new google.maps.Map(document.getElementById('map_container'), mapOptions);
                directionsDisplay.setMap(map);
            }
            $(function(){

                initialize();
            });
        </script>
        <style type="text/css">
            #map_container{
                width: 90%;
                height: 500px;
                background: #999;
                margin-left: 5%;
            }
        </style>
    </head>
    <body id="top">
    <?php
    // include 'dbconnect.php';
    include('includes/header_en.php');
    ?>

    <center><h1>Visited by me</h1></center>
    <?php if(empty($visited)): ?>
        <center><p>You have no sights visited</p></center>
    <?php else: ?>
        <div id="map_container"></div>
<!--        tuka she imame dr prostotii-->
    <?php endif; ?>

    </body>
    </html>
<?php
include 'includes/footer_en.php';
?>