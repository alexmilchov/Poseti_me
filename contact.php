<!DOCTYPE html>
<html>
<head>
    <title>Посети ме!</title>
    <link rel="shortcut icon" type="image/png" href="images/logo_title.png"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="layout/styles/contact.css" rel="stylesheet" type="text/css" media="all">
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <style type="text/css">

    </style>
</head>
<body id="top">
<?php
include 'dbconnect.php';
include('includes/header.php');
?>
<header class="ccheader">
    <h1>Контактна форма</h1>
</header>
<div class="wrapper">
    <form method="post" action="" id="contactForm" name="contactForm" class="ccform">
        <div class="ccfield-prepend">
            <span class="ccform-addon"><i class="fa fa-user fa-2x"></i></span>
            <input class="ccformfield" type="text" id="contactName" name="contactName" placeholder="Имена" required>
        </div>
        <div class="ccfield-prepend">
            <span class="ccform-addon"><i class="fa fa-envelope fa-2x"></i></span>
            <input class="ccformfield" type="text"  id="contactEmail" name="contactEmail" placeholder="Имейл" required>
        </div>
        <div class="ccfield-prepend">
            <span class="ccform-addon"><i class="fa fa-info fa-2x"></i></span>
            <input class="ccformfield" type="text" id="contactSubject" name="contactSubject" placeholder="Предмет на запитване" required>
        </div>
        <div class="ccfield-prepend">
            <span class="ccform-addon"><i class="fa fa-comment fa-2x"></i></span>
            <textarea class="ccformfield" id="contactMessage" name="contactMessage" rows="8" placeholder="Съобщение" required></textarea>
        </div>
        <div class="ccfield-prepend">
            <input class="ccbtn" name="action"" type="submit" value="Потвърди">
        </div>
    </form>
    <?php

    $siteOwnersEmail = 'alex_milchov02@abv.bg';
    // $siteOwnersEmail = 'poseti_me@abv.bg';

    if($_POST) {

        $name = trim(stripslashes($_POST['contactName']));
        $email = trim(stripslashes($_POST['contactEmail']));
        $subject = trim(stripslashes($_POST['contactSubject']));
        $contact_message = trim(stripslashes($_POST['contactMessage']));


        if (strlen($name) < 1) {
            $error['name'] = "Въведете своите имена.";
        }

        if (!preg_match('/^[a-z0-9&\'\.\-_\+]+@[a-z0-9\-]+\.([a-z0-9\-]+\.)*+[a-z]{2}/is', $email)) {
            $error['email'] = "Въведете валиден имейл адрес.";
        }

        if (strlen($contact_message) < 1) {
            $error['message'] = "Моля въведете своето съобщение.То нетрябва да бъде повече от 100 символа.";
        }

        if ($subject == '') {
            $subject = "Contact Form Submission"; 
        }



        $message .= "Имейл от: " . $name . "<br />";
        $message .= "Имейл адрес: " . $email . "<br />";
        $message .= "Съобщение: <br />";
        $message .= $contact_message;
        $message .= "<br /> ----- <br /> Този имейл беше изпратен от вашият сайт 'Посети ме!'. <br />";


        $from =  $name . " <" . $email . ">";


        $headers = "From: " . $from . "\r\n";
        $headers .= "Reply-To: ". $email . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";


        if (!$error) {

            ini_set("sendmail_from", $siteOwnersEmail); // for windows server
            $mail = mail($siteOwnersEmail, $subject, $message, $headers);

            if ($mail) { echo "Съобщението е изпратено"; }
            else { echo "Нещо се обърка. Опитай отново!"; }

        }

        else {

            $response = (isset($error['name'])) ? $error['name'] . "<br /> \n" : null;
            $response .= (isset($error['email'])) ? $error['email'] . "<br /> \n" : null;
            $response .= (isset($error['message'])) ? $error['message'] . "<br />" : null;

            echo $response;

        }

    }

    ?>
</div>
<div class="credit">
</div>
</body>
</html>
<?php
include 'includes/footer.php';
?>
