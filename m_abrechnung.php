<?php
//session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
$user = check_user();

include("templates/header.inc.php");
?>

<script src="js/bootstrap-datepicker.js"></script>
<link href="css/bootstrap-datepicker.css" rel="stylesheet"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Mitarbeiter Bereich</h3></h3>
        </div>

        <ul class="list-unstyled components">
            <!-- <p>Navigation</p> -->
            <li class="">
                <a href="internal.php" >Startseite</a>
            </li>
            <li>
                <a href="news.php">News</a>
            </li>
            <li>
                <a href="#">Kontakt</a>
            </li>
            <li>
                <a href="settings.php">Einstellungen</a>
            </li>
            <?php
            if (@$user['role'] == "admin") {
              ?><li class="nav-item register"><a class="nav-link" style="color:red;" href="register.php">add User</a></li><?php
              ?><li class="nav-item m_abrechnung"><a class="nav-link" style="color:red;" href="m_abrechnung.php">M-Abrechnungen</a></li><?php
              ?><li class="nav-item create"><a class="nav-link" style="color:red;" href="u_antrag.php">U-Anträge</a></li><?php
            }
            ?>
            <li>
                <a href="logout.php">Logout</a>
            </li>

        </ul>


    </nav>

    <!-- Page Content Holder -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <div class="navbar-header">
                    <button type="button" id="sidebarCollapse" class="btn btn-lg btn-info navbar-btn">
                        <i class="fas fa-align-left"></i>
                        <span> Navigation</span>
                    </button>
                </div>

                <div class="col-sm-4">
                    <div class="pull-right">
                      <h4><i class="fa fa-id-card"></i><b> Current User</b></h4>
                      <span style="text-decoration: underline">Name:</span> <?php echo htmlentities($user['vorname']); ?> <?php echo htmlentities($user['nachname']); ?><br>
                      <span style="text-decoration: underline">Rolle:&nbsp;</span> <?php echo htmlentities($user['role']); ?><br>
                    </div>
                </div>

            </div>
        </nav>

        		<div class="container-fluid">
        				<h1>Monatsabrechnung</h1>
        		</div>

    <div class="container-fluid">

<br>


<form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="timeform" hidden>
  <div class="form-group">
    <label class="control-label col-sm-2" for="datepickerYear">
     Jahr:
    </label>
    <div class="col-sm-10">
      <input type="text" name="datepickerYear" id="datepickerYear" data-target="#datepickerYear" class="form-control"/>
    </div>
  </div>
</br>
  <div class="form-group">
    <label class="control-label col-sm-2" for="datepickerMonth">
     Monat:
    </label>
    <div class="col-sm-10">
      <input type="text" name="datepickerMonth" id="datepickerMonth" data-target="#datepickerMonth" class="form-control"/>
    </div>
  </div>

  <div class="form-group">
   <div class="col-sm-10 col-sm-offset-2">
    <button class="btn btn-primary btn-lg" name="submit" type="submit">
     weiter
    </button>
   </div>
  </div>
</form>
</div>
</div>

<br />

<script>
$("#datepickerYear").datepicker({
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years",
    autoclose: true
});

$("#datepickerMonth").datepicker({
    format: "mm",
    viewMode: "months",
    minViewMode: "months",
    autoclose: true
});
</script>

<?php

$list=array();
$month = @$_POST['datepickerMonth'];
$year = @$_POST['datepickerYear'];

if ($year<=0 || $month<=0) {
  ?>
  <script>
  document.getElementById("timeform").hidden=false;
  </script>
  <?php
}else {
  ?>
  <script>
  $("#timeform").hide();
  document.getElementById("timeform").hidden=true;
  </script>

</br>
<div class="col-sm-12">
<?php

//$number = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31
//echo "<b>Der {$month}-{$year} hatte {$number} Tage</b> <br/><br/><br/>";

for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);
    if (date('m', $time)==$month)
        $list[]=date('d.m.Y l', $time);

}

?>
<nav class="navbar navbar-default">
    <div class="container center" style="width:75%;padding-left:5%">

<table class="table table-striped table-hover" style="width:100%;font-size:80%;">
    <thead>
    <tr>
        <th style="width:50px;">Datum</th>
        <th style="width:50px;">geleistete Stunden</th>
        <th style="width:50px;">Überstunden</th>
    </tr>
</thead>
<tbody>
<?php

foreach($list as $value): ?>
  <tr>
      <!-- ternary expression durch form-control geht die hier gecodete valiedierung nicht -->
      <td style="font-size:110%;"> <?= $value; ?> </td>
      <td> <?="<input type='number' class='textfield form-control' value='' id='onlyNumbers' name='onlyNumbers' min='0' max='12' onkeypress='return isNumber(event)' onpaste='return false;'/><br>"; ?> </td>
      <td> <?="<input type='number' class='textfield form-control' value='' id='onlyNumbers' name='onlyNumbers' min='0' max='12' onkeypress='return isNumber(event)' onpaste='return false;'/><br>"; ?> </td>
  </tr>
  <script type="text/javascript">
  function isNumber(evt) {
          evt = (evt) ? evt : window.event;
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if ( (charCode > 31 && charCode < 48) || charCode > 57) {
              return false;
          }
          return true;
      }
  </script>

<?php endforeach;
}
?>
</table>

</div>
</nav>





</div>
</div>
<?php
include("templates/footer.inc.php");
?>
