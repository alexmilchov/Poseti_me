<?php
require_once 'dbconnect.php';
$email = '';
$passError = '';
$emailError = '';
if ( isset($_SESSION['user'])!="" ) {
    header("Location: index.php");
    exit;
}

$error = false;

if( isset($_POST['btn-login']) ) {


    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);


    if(empty($email)){
        $error = true;
        $emailError = "Въведи имейл.";
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        $error = true;
        $emailError = "Въведи валиден имейл адрес.";
    }

    if(empty($pass)){
        $error = true;
        $passError = "Въведи парола.";
    }


    if (!$error) {

        $password = hash('sha256', $pass);

        $res=mysql_query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
        $row=mysql_fetch_array($res);
        $count = mysql_num_rows($res);

        if( $count == 1 && $row['userPass']==$password ) {
            $_SESSION['user'] = $row['userId'];
            header("Location: index.php");
        } else {
            $errMSG = "
Неправилни идентификационни данни, опитайте отново...";
        }

    }

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Посети ме!</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
    <link rel="stylesheet" href="style.css" type="text/css" />
    <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="shortcut icon" type="image/png" href="images/logo_title.png"/>

</head>
<body id="top">
<?php
include('includes/header.php');
?>

<div class="container">
    <div id="login-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
            <div class="col-md-12">
                <div class="form-group">
                    <h2 class="">Влез в профил</h2>
                </div>
                <div class="form-group">
                    <hr />
                </div>

                <?php if (isset($errMSG)) : ?>
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <span class="glyphicon glyphicon-info-sign"></span><?php echo $errMSG; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                        <input type="email" name="email" class="form-control" placeholder="Имейл" value="<?php echo $email; ?>" maxlength="40" />
                    </div>
                    <span class="text-danger"><?php echo $emailError; ?></span>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                        <input type="password" name="pass" class="form-control" placeholder="Парола" maxlength="15" />
                    </div>
                    <span class="text-danger"><?php echo $passError; ?></span>
                </div>
                <hr />
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary" name="btn-login">Влез в профила</button>
                </div>
                <a href="register.php">Регистрирай се тук...</a>
            </div>
        </form>
    </div>
</div>
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>