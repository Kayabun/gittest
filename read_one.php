<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

include("templates/header.inc.php");
?>



<!DOCTYPE HTML>
<html>
<head>
    <!-- Latest compiled and minified Bootstrap CSS -->
 
</head>
<body>
    
    <div role="navigation" id="foo" class="nav-collapse">
      <ul>
        <li class="active"><a href="internal.php">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="settings.php">My Account</a></li>
            <a href="logout.php"><button class="btn btn-danger">Logout</button></a>
      </ul>
    </div>
 
     <div role="main" class="main panel panel-default">
      <a href="#nav" class="nav-toggle">Menu</a>
    <!-- container -->
    <div class="container" style="width: 100%">
        <br>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <a href='internal.php' class='btn btn-default m-b-1em'><i class='fa fa-arrow-left'></i></a>
                    <div class="col-md-12">
                        <div class="page-header clearfix">                            
                            <h1 class="pull-left">View one Study</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- PHP read one record will be here -->
        <?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
//include database connection
include 'config/database.php';
 
// read current record's data
try {
    // prepare select query
    //id,title_of_the_clinical_trial,study_number,name_of_sponsor,phase,type_of_product,date_of_submission_to_nra,date_of_submission_to_ec,parallel_submission_to_nra_and_ec,review_type,nra_review_date,ec_review_date,ec_approval_date,nra_queries_submission_date,query_type,response_date_to_nra_queries,nra_approval_date,nra_date_of_rejection,date_of_authorization_or_rejection,main_reason_for_delay_in_approval,timeline_for_ec_review,timeline_for_ec_approval,timeline_for_nra_review,timeline_for_nra_approval,timeline_for_ct_authorization,delay_between_ec_approval_and_submission_nra
$query = "SELECT * FROM study_data WHERE id = ? LIMIT 0,1";
    $stmt = $con->prepare( $query );
 
    // this is the first question mark
    $stmt->bindParam(1, $id);
 
    // execute our query
    $stmt->execute();
 
    // store retrieved row to a variable
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
    // values to fill up our form
    $title_of_the_clinical_trial = $row['title_of_the_clinical_trial'];
    $study_number = $row['study_number'];
    $name_of_sponsor = $row['name_of_sponsor'];
    $phase = $row['phase'];
    $type_of_product = $row['type_of_product'];
    $date_of_submission_to_nra = $row['date_of_submission_to_nra'];
    $date_of_submission_to_ec = $row['date_of_submission_to_ec'];
    $parallel_submission_to_nra_and_ec = $row['parallel_submission_to_nra_and_ec'];
    $review_type = $row['review_type'];
    $nra_review_date = $row['nra_review_date'];
    $ec_review_date = $row['ec_review_date'];
    $ec_approval_date = $row['ec_approval_date'];
    $nra_queries_submission_date = $row['nra_queries_submission_date'];
    $query_type = $row['query_type'];
    $response_date_to_nra_queries = $row['response_date_to_nra_queries'];
    $nra_approval_date = $row['nra_approval_date'];
    $nra_date_of_rejection = $row['nra_date_of_rejection'];
    $date_of_authorization_or_rejection = $row['date_of_authorization_or_rejection'];
    $main_reason_for_delay_in_approval = $row['main_reason_for_delay_in_approval'];
    $timeline_for_ec_review = $row['timeline_for_ec_review'];
    $timeline_for_ec_approval = $row['timeline_for_ec_approval'];
    $timeline_for_nra_review = $row['timeline_for_nra_review'];
    $timeline_for_nra_approval = $row['timeline_for_nra_approval'];
    $timeline_for_ct_authorization = $row['timeline_for_ct_authorization'];
    $delay_between_ec_approval_and_submission_nra = $row['delay_between_ec_approval_and_submission_nra'];
    
}
 
// show error
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}
?>
 
        <!-- HTML read one record table will be here -->
        <!--we have our html table here where the record will be displayed-->

<div class="table-responsive col-md-12">
<table class='table table-hover table-bordered table-striped'>
    <tr>
        <td class="col-md-4">id</td>
        <td class="col-md-8"><?php echo htmlspecialchars($id, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>title_of_the_clinical_trial</td>
        <td><?php echo htmlspecialchars($title_of_the_clinical_trial, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>study_number</td>
        <td><?php echo htmlspecialchars($study_number, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>name_of_sponsor</td>
        <td><?php echo htmlspecialchars($name_of_sponsor, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>phase</td>
        <td><?php echo htmlspecialchars($phase, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>type_of_product</td>
        <td><?php echo htmlspecialchars($type_of_product, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>date_of_submission_to_nra</td>
        <td><?php echo htmlspecialchars($date_of_submission_to_nra, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>date_of_submission_to_ec</td>
        <td><?php echo htmlspecialchars($date_of_submission_to_ec, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>parallel_submission_to_nra_and_ec</td>
        <td><?php echo htmlspecialchars($parallel_submission_to_nra_and_ec, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>review_type</td>
        <td><?php echo htmlspecialchars($review_type, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>nra_review_date</td>
        <td><?php echo htmlspecialchars($nra_review_date, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>ec_review_date</td>
        <td><?php echo htmlspecialchars($ec_review_date, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>ec_approval_date</td>
        <td><?php echo htmlspecialchars($ec_approval_date, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>nra_queries_submission_date</td>
        <td><?php echo htmlspecialchars($nra_queries_submission_date, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>query_type</td>
        <td><?php echo htmlspecialchars($query_type, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>response_date_to_nra_queries</td>
        <td><?php echo htmlspecialchars($response_date_to_nra_queries, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>nra_approval_date</td>
        <td><?php echo htmlspecialchars($nra_approval_date, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>nra_date_of_rejection</td>
        <td><?php echo htmlspecialchars($nra_date_of_rejection, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>date_of_authorization_or_rejection</td>
        <td><?php echo htmlspecialchars($date_of_authorization_or_rejection, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>main_reason_for_delay_in_approval</td>
        <td><?php echo htmlspecialchars($main_reason_for_delay_in_approval, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>timeline_for_ec_review</td>
        <td><?php echo htmlspecialchars($timeline_for_ec_review, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>timeline_for_ec_approval</td>
        <td><?php echo htmlspecialchars($timeline_for_ec_approval, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>timeline_for_nra_review</td>
        <td><?php echo htmlspecialchars($timeline_for_nra_review, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>timeline_for_nra_approval</td>
        <td><?php echo htmlspecialchars($timeline_for_nra_approval, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>timeline_for_ct_authorization</td>
        <td><?php echo htmlspecialchars($timeline_for_ct_authorization, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td>delay_between_ec_approval_and_submission_nra</td>
        <td><?php echo htmlspecialchars($delay_between_ec_approval_and_submission_nra, ENT_QUOTES);  ?></td>
    </tr>
    <tr>
        <td></td>
        <td>
            <a href='internal.php' class='btn btn-danger'>Back</a>
        </td>
    </tr>
</table>
</div>    
     
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <?php 
        include("templates/footer.inc.php")
    ?>
 
</body>
</html>