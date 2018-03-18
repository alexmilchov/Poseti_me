<!DOCTYPE html>
<html>
<head>
    <title>Visit me!</title>
    <link rel="shortcut icon" type="image/png" href="images/logo_title.png"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <style type="text/css">
        .container .demo{text-align:center;}
        .container .demo div{padding:8px 0;}
        .container .demo div:nth-child(odd){color:#FFFFFF; background:#CCCCCC;}
        .container .demo div:nth-child(even){color:#FFFFFF; background:#979797;}
        @media screen and (max-width:900px){.container .demo div{margin-bottom:0;}}
    </style>
</head>
<body id="top">
<?php
include 'dbconnect.php';
include('includes/header_en.php');
?>
<div class="wrapper row4 bgded overlay" style="background-image:url('images/demo/backgrounds/black.jpg');">
    <footer id="footer" class="hoc clear">
        <section class="our-services slideanim" id="service">
            <h3 class="text-center slideanim">For site</h3>
            <div id="features">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 centered">
                            <div class="accordion ac" id="accordion2">
                                <div class="accordion-group">
                                    <div class="accordion-heading">
                                        <a class="accordion-toggle slideanim" data-toggle="collapse" data-parent="#accordion2" ><h1>
                                                What is the purpose of the site?</h1></a>
                                    </div>
                                    <div id="collapseOne" class="accordion-body collapse in">
                                        <div class="accordion-inner slideanim">
                                            <p>The project is an interactive guide for every lover of travel. Using the GOOGLE MAPS API, combined with landmarks and their geocurtains, the system selects the best route to a destination by offering close-to-view locations within a certain radius.</</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle slideanim" data-toggle="collapse" data-parent="#accordion2" ><h1>Who are the sources of information?</h1></a>
                                        </div>
                                        <div id="collapseTwo" class="accordion-body collapse">
                                            <div class="accordion-inner slideanim">
                                                <div style="text-align:left">
                                                    <p><a href="https://en.wikipedia.org" target="_blank">Wikipedia</p>
                                                    <p><a href="https://developers.google.com/maps" target="_blank">Google Maps APIs</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a class="accordion-toggle slideanim" data-toggle="collapse" data-parent="#accordion2" ><h1>Which technologies are used on the site?</h1></a>
                                        </div>
                                        <div id="collapseThree" class="accordion-body collapse">
                                            <div class="accordion-inner slideanim">
                                                <img src="images/php.jpg" style="width:100px;height:100px;">
                                                <img src="images/mysql.png" style="width:100px;height:100px;">
                                                <img src="images/apache_logo.jpg" style="width:100px;height:100px;">
                                                <img src="images/css3.jpg" style="width:100px;height:100px;">
                                                <img src="images/html5.jpg" style="width:100px;height:100px;">
                                                <img src="images/js.jpg" style="width:100px;height:100px;">
                                                <img src="images/JQuery.png" style="width:100px;height:100px;">
                                                <img src="images/google maps API.png" style="width:100px;height:100px;">
                                                <img src="images/pdo.jpg" style="width:100px;height:100px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </footer>
</div>
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>
<?php
include 'includes/footer_en.php';
?>