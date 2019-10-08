<?php
//session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
$user = check_user();
?>
<!--
<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>

</head>
-->
<body>
  <h2 class="center"><u>Interner Bereich</u></h2>
<br>
    <a href="m_abrechnung.php" class="btn btn-lg btn-warning" role="button">Monatsabrechnung</a>
    <br>
    <br>

    <a href="m_abrechnung_calendar.php" class="btn btn-lg btn-warning" role="button">Kalender</a>
    <br>
    <br>

    <a href="u_antrag.php" class="btn btn-lg btn-warning" role="button">Urlaubsantrag</a>
    <br>
    <br>

<?php
// include database connection
include 'inc/config.inc.php';
?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins)
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

 Latest compiled and minified Bootstrap JavaScript
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
