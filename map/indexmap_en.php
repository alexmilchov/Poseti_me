<!DOCTYPE html>
<html>
<head>
<title>Visit me!</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<style type="text/css">
.container .demo{text-align:center;}
.container .demo div{padding:8px 0;}
.container .demo div:nth-child(odd){color:#FFFFFF; background:#CCCCCC;}
.container .demo div:nth-child(even){color:#FFFFFF; background:#979797;}
@media screen and (max-width:900px){.container .demo div{margin-bottom:0;}}
</style>
</head>
<?php 
	include "map_php/init.php";
	include '../dbconnect.php';
	if(!isset($userRow['userName'])){
		header("Location: ".Base_url()."login_en.php");
	}
	
	$zabelejitelnosti = $db->getAllSights();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Map</title>
    <link rel="shortcut icon" type="image/png" href="../images/logo_title.png"/>
    <style type="text/css">
        #map_container{
            width: 90%;
            height: 500px;
            background: #999;
            margin-left: 5%;
            margin-bottom:15px;
        }
        /*display: none;*/


        #load_map_btn {
            background: #db5935;
            background-image: -webkit-linear-gradient(top, #db5935, #080702);
            background-image: -moz-linear-gradient(top, #db5935, #080702);
            background-image: -ms-linear-gradient(top, #db5935, #080702);
            background-image: -o-linear-gradient(top, #db5935, #080702);
            background-image: linear-gradient(to bottom, #db5935, #080702);
            -webkit-border-radius: 28;
            -moz-border-radius: 28;
            border-radius: 28px;
            font-family: Arial;
            color: #ffffff;
            font-size: 20px;
            padding: 10px 20px 10px 20px;
            text-decoration: none;
        }

        #load_map_btn:hover {
            background: #db5935;
            background-image: -webkit-linear-gradient(top, #db5935, #000000);
            background-image: -moz-linear-gradient(top, #db5935, #000000);
            background-image: -ms-linear-gradient(top, #db5935, #000000);
            background-image: -o-linear-gradient(top, #db5935, #000000);
            background-image: linear-gradient(to bottom, #db5935, #000000);
            text-decoration: none;
        }




        #show_circles_btn {
            background: #db5935;
            background-image: -webkit-linear-gradient(top, #db5935, #080702);
            background-image: -moz-linear-gradient(top, #db5935, #080702);
            background-image: -ms-linear-gradient(top, #db5935, #080702);
            background-image: -o-linear-gradient(top, #db5935, #080702);
            background-image: linear-gradient(to bottom, #db5935, #080702);
            -webkit-border-radius: 28;
            -moz-border-radius: 28;
            border-radius: 28px;
            font-family: Arial;
            color: #ffffff;
            font-size: 20px;
            padding: 10px 20px 10px 20px;
            text-decoration: none;
        }

        #show_circles_btn:hover {
            background: #db5935;
            background-image: -webkit-linear-gradient(top, #db5935, #000000);
            background-image: -moz-linear-gradient(top, #db5935, #000000);
            background-image: -ms-linear-gradient(top, #db5935, #000000);
            background-image: -o-linear-gradient(top, #db5935, #000000);
            background-image: linear-gradient(to bottom, #db5935, #000000);
            text-decoration: none;
        }
#input_radius{
    width:185px;
}
    </style>
</head>
<body id="top">
<?php
include '../includes/header_en.php';
?>
<br><center><h1>Start the trip!</h1></center>

<center>Starting point<input type="text" name="FirstName" value="" id="input_startpoint"><br></center>
<center><p><i><b>The starting point should be a city, landmark, or home address where you want to start the trip! (Example: Pernik)</i></b></p>
    <center>End point<input type="text" name="LastName" value="" id="input_endpoint"><br></center>
    <center><p><i><b>For a destination, choose a city, landmark or home address that is your final travel destination! (Example: Varna)</i></b></p>
        <center>Radius in kilometers<input type="number" min="0" max="100" name="LastName" value="" id="input_radius"><br></center>
        <center><p><i><b>The radius shows the landmarks depending on the set route! (Example: 10)</p></i></b></center>
        <center><input id="show_circles_btn" type="submit" value="Show landmarks"></center>

        <hr />
        <img src="../images/marker_blue.png" alt="marker_blue"> - The hundred national tourist sites in Bulgaria
        <img src="../images/marker_red.png" alt="marker_red"> - Landmarks in Bulgaria and Europe
        <div id="map_container"></div>
         </br>
        <script src="map_js/jquery.min.js"></script>
        <script src="map_js/notify.min.js"></script>
        <script src="https://maps.google.com/maps/api/js?libraries=geometry,places&amp;v=3.24&amp;key=AIzaSyAgVIdad7TaiqrIYHSvg8hgKq84RuRKo7s"></script>

		
        <script type="text/javascript">

            var json_string = '<?php echo str_replace(array('\n','\r'),'',json_encode($zabelejitelnosti)) ?>';
            var json = JSON.parse(json_string);

            json.forEach(function(element) {
                element['displayed'] = false;
                element['s_lat'] = parseFloat(element['s_lat']);
                element['s_lng'] = parseFloat(element['s_lng']);
            });
        </script>

        <script type="text/javascript" src="map_js/map_funcs_en.js"></script>
</body>
</html>
<?php include '../includes/footer_en.php'; ?>