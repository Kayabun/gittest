<?php
session_start();
session_destroy();
unset($_SESSION['userid']);

//Remove Cookies
setcookie("identifier","",time()-(3600*24*365));
setcookie("securitytoken","",time()-(3600*24*365));

require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>kmhv</title>

        <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="css/style_2.css"> <!-- Resource style -->
    <link href="css/style.css" rel="stylesheet">
    <!--[if lte IE 8]><link rel="stylesheet" href="../../responsive-nav.css"><![endif]-->
    <!--[if gt IE 8]><!--><link rel="stylesheet" href="css/style.css"><!--<![endif]-->
    <script src="js/responsive-nav.js"></script>
  </head>


<div class="container h-100">
  <div class="row h-100 justify-content-center align-items-center">
    <h2>Der Logout war erfolgreich. <br><a href="login.php">Zurück zum Login</a>.</h2>
  </div>
</div>
<?php
include("templates/footer.inc.php")
?>
