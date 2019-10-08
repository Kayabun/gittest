<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

include("templates/header.inc.php");
include("templates/nav.inc.php");
?>


<!DOCTYPE HTML>
<html>
<head>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
</head>
<body>

    <!-- container -->
    <div class="container" style="width: 100%">
    <br>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <a href='internal.php' class='btn btn-default m-b-1em'><i class='fa fa-arrow-left'></i></a>
                    <div class="col-md-12">
                        <div class="page-header clearfix">
                            <h1 class="pull-left">Monatsabrechnung</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />-->

<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>


    <?php
if($_POST){

    //TO-DO
    //1. Das Land muss bei automatisch ausgewählt sein



    // include database connection
    include 'inc/config.inc.php';

    try{

        // insert query
        $query = "INSERT INTO m SET"
                . " spalte1=:spalte1,"
                . " spalte2=:spalte2,"
                . " spalte3=:spalte3";

        // prepare query for execution
        $stmt = $con->prepare($query);

        // posted values
        $spalte1=htmlspecialchars(strip_tags($_POST['spalte1']));
        $spalte2=htmlspecialchars(strip_tags($_POST['spalte2']));
        $spalte3=htmlspecialchars(strip_tags($_POST['spalte3']));


        // bind the parameters
        $stmt->bindParam(':spalte1', $spalte1);
        $stmt->bindParam(':spalte2', $spalte2);
        $stmt->bindParam(':spalte3', $spalte3);


        // specify when this record was inserted to the database
        //$created=date('Y-m-d H:i:s');
        //$stmt->bindParam(':created', $created);

        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success' role='alert'>Record was saved. <a href='internal.php' class=''>--->back to study Table</a></div>";
        }else{
            echo "<div class='alert alert-danger' role='alert'>Unable to save record. <a href='internal.php' class=''>--->back to study Table</a></div>";
        }

    }

    // show error
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>

<!-- HTML Form (wrapped in a .bootstrap-iso div) -->
<div class="bootstrap-iso">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
         <div class="form-group">
          <label class="control-label col-sm-2 requiredField" for="spalte1">
          spalte1
          <a href="#" data-toggle="tooltip" title="Hier Text eingeben">*</a>
          </label>
          <div class="col-sm-10">
            <div class="input-group">
              <div class="input-group-addon">
              <i class="fa fa-pencil-square-o">
              </i>
              </div>
           <textarea class="form-control" cols="40" id="spalte1" name="spalte1"  rows="5" placeholder="..." type="text"></textarea>
          </div>
        </div>
      </div>
<br></br>

      <div class="form-group ">
       <label class="control-label col-sm-2" for="spalte2">
        spalte2
       </label>
       <div class="col-sm-10">
        <div class="input-group">
         <div class="input-group-addon">
         <i class="fa fa-pencil-square-o">
         </i>
         </div>
        <input class="form-control" id="spalte2" name="spalte2" placeholder="..." type="text"/>
        </div>
        <span class="help-block" id="hint_spalte2">
            <i class="fa fa-info-circle" style="color:lightskyblue"></i> Field info info info info info
        </span>
      </div>
    </div>
<br></br>

    <div class="form-group ">
     <label class="control-label col-sm-2 requiredField" for="spalte3">
      spalte3
       <a href="#" data-toggle="tooltip" title="Hier Text eingeben2">*</a>
    </label>
      <div class="col-sm-10">
       <div class="input-group">
        <div class="input-group-addon">
        <i class="fa fa-pencil-square-o">
        </i>
        </div>
      <input class="form-control" id="spalte3" name="spalte3" placeholder="..." type="text"/>
      </div>
     </div>
    </div>
<br></br>

          <div class="form-group">
              <div class="input-group date" id="datetimepicker11" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker11"/>
                  <div class="input-group-append" data-target="#datetimepicker11" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div>
  <br></br>

          <div class="form-group">
              <div class="input-group date" id="datetimepicker14" data-target-input="nearest">
                  <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker14"/>
                  <div class="input-group-append" data-target="#datetimepicker14" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
              </div>
          </div>

            </div>
            <div class="form-group">
             <div class="col-sm-10 col-sm-offset-2">
              <button class="btn btn-primary btn-lg" name="submit" type="submit">
               Save
              </button>
             </div>
            </div>
           </form>
          </div>
         </div>
        </div>
       </div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins)
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

Latest compiled and minified Bootstrap JavaScript
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->

<?php
    include("templates/footer.inc.php")
?>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

<script>
    $(function () {
        $('#datetimepicker11').datetimepicker({
            viewMode: 'years',
            format: 'MM/YYYY'
        });
    });
</script>

<script>
    $(function () {
        $('#datetimepicker14').datetimepicker({
            allowMultidate: true,
            multidateSeparator: ','
        });
    });
</script>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>

</body>
</html>
