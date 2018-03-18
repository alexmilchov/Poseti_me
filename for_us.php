<!DOCTYPE html>
<html>
<head>
    <title>Посети ме!</title>
    <link rel="shortcut icon" type="image/png" href="images/logo_title.png"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <style type="text/css">
        /* DEMO ONLY */
        .container .demo{text-align:center;}
        .container .demo div{padding:8px 0;}
        .container .demo div:nth-child(odd){color:#FFFFFF; background:#CCCCCC;}
        .container .demo div:nth-child(even){color:#FFFFFF; background:#979797;}
        @media screen and (max-width:900px){.container .demo div{margin-bottom:0;}}
        /* DEMO ONLY */
    </style>
</head>
<body id="top">
<?php
include 'dbconnect.php';
include('includes/header.php');
?>

<div class="wrapper row4 bgded overlay" style="background-image:url('images/demo/backgrounds/black.jpg');">
    <footer id="footer" class="hoc clear">
        <h1>За нас</h1>
        <p>Ние сме ученици от Vlllв клас на Професионална гимназия по икономика-гр.Перник. Нашата специалност е Икономическа информатика и решихме да се включим в олимпиадата по информационни технологии, за да покажем нашите знания и умения.</p>
        <hr>
        <br>
        <br>
        <br>
        <img src="images/map-marker.png" align="left" style="width:150px;height:150px;">
        <h1 class="tittle two">Къде се намираме?</h1>
        <p>За повече въпроси и връзка с нас може да ни пишете, посредством формата за контакт в нашия сайт!</p>
        <div class="contact-ad">
            <p>ПГИ - гр. Перник</p><p>
            </p><p>Адрес: гр. Перник, ул. Г. Мамарчев, 2</p><p>
            </p></div>
        <br>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1746.125059774242!2d23.046861522361894!3d42.60579239429677!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14aacadf4ba43b73%3A0x28028560258f88be!2z0J_RgNC-0YTQtdGB0LjQvtC90LDQu9C90LAg0LPQuNC80L3QsNC30LjRjyDQv9C-INC40LrQvtC90L7QvNC40LrQsA!5e0!3m2!1sbg!2sbg!4v1483102486254" width="500" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
    </footer>
</div>

<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>
<?php
include 'includes/footer.php';
?>