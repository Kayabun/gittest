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
    <title>PDO - Update a Record - PHP CRUD Tutorial</title>
     
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
                            <h1 class="pull-left">Edit Study</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>  

<!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!--Font Awesome (added because you use icons in your prepend/append)-->
<link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

<!-- Inline CSS based on choices in "Settings" tab -->
<style>.bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;} .asteriskField{color: red;}</style>

    
        <!-- PHP read record by ID will be here -->
        <?php
// get passed parameter value, in this case, the record ID
// isset() is a PHP function used to verify if a value is there or not
$id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
 
//include database connection
include 'config/database.php';
 
// read current record's data
try {
    // prepare select query
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
 
        <!-- HTML form to update record will be here -->
        <!-- PHP post to update record will be here -->
        <?php
 
// check if form was submitted
if($_POST){
     
    try{
     
        // write update query
        // in this case, it seemed like we have so many fields to pass and 
        // it is better to label them and not use question marks
        $query = "UPDATE study_data
            SET title_of_the_clinical_trial=:title_of_the_clinical_trial,
                study_number=:study_number,
                name_of_sponsor=:name_of_sponsor,
                phase=:phase,
                type_of_product=:type_of_product,
                date_of_submission_to_nra=:date_of_submission_to_nra,
                date_of_submission_to_ec=:date_of_submission_to_ec,
                parallel_submission_to_nra_and_ec=:parallel_submission_to_nra_and_ec,
                review_type=:review_type,
                nra_review_date=:nra_review_date,
                ec_review_date=:ec_review_date,
                ec_approval_date=:ec_approval_date,
                nra_queries_submission_date=:nra_queries_submission_date,
                query_type=:query_type,
                response_date_to_nra_queries=:response_date_to_nra_queries,
                nra_approval_date=:nra_approval_date,
                nra_date_of_rejection=:nra_date_of_rejection,
                date_of_authorization_or_rejection=:date_of_authorization_or_rejection,
                main_reason_for_delay_in_approval=:main_reason_for_delay_in_approval,
                timeline_for_ec_review=:timeline_for_ec_review,
                timeline_for_ec_approval=:timeline_for_ec_approval,
                timeline_for_nra_review=:timeline_for_nra_review,
                timeline_for_nra_approval=:timeline_for_nra_approval,
                timeline_for_ct_authorization=:timeline_for_ct_authorization,
                delay_between_ec_approval_and_submission_nra=:delay_between_ec_approval_and_submission_nra
            WHERE id = :id";
 
        // prepare query for excecution
        $stmt = $con->prepare($query);
 
        // posted values
        $title_of_the_clinical_trial=htmlspecialchars(strip_tags($_POST['title_of_the_clinical_trial']));
        $study_number=htmlspecialchars(strip_tags($_POST['study_number']));
        $name_of_sponsor=htmlspecialchars(strip_tags($_POST['name_of_sponsor']));
        $phase=htmlspecialchars(strip_tags($_POST['phase']));
        $type_of_product=htmlspecialchars(strip_tags($_POST['type_of_product']));
        $date_of_submission_to_nra=htmlspecialchars(strip_tags($_POST['date_of_submission_to_nra']));
        $date_of_submission_to_ec=htmlspecialchars(strip_tags($_POST['date_of_submission_to_ec']));
        $parallel_submission_to_nra_and_ec=htmlspecialchars(strip_tags($_POST['parallel_submission_to_nra_and_ec']));
        $review_type=htmlspecialchars(strip_tags($_POST['review_type']));
        $nra_review_date=htmlspecialchars(strip_tags($_POST['nra_review_date']));
        $ec_review_date=htmlspecialchars(strip_tags($_POST['ec_review_date']));
        $ec_approval_date=htmlspecialchars(strip_tags($_POST['ec_approval_date']));
        $nra_queries_submission_date=htmlspecialchars(strip_tags($_POST['nra_queries_submission_date']));
        $query_type=htmlspecialchars(strip_tags($_POST['query_type']));
        $response_date_to_nra_queries=htmlspecialchars(strip_tags($_POST['response_date_to_nra_queries']));
        $nra_approval_date=htmlspecialchars(strip_tags($_POST['nra_approval_date']));
        $nra_date_of_rejection=htmlspecialchars(strip_tags($_POST['nra_date_of_rejection']));
        $date_of_authorization_or_rejection=htmlspecialchars(strip_tags($_POST['date_of_authorization_or_rejection']));
        $main_reason_for_delay_in_approval=htmlspecialchars(strip_tags($_POST['main_reason_for_delay_in_approval']));
        $timeline_for_ec_review=htmlspecialchars(strip_tags($_POST['timeline_for_ec_review']));
        $timeline_for_ec_approval=htmlspecialchars(strip_tags($_POST['timeline_for_ec_approval']));
        $timeline_for_nra_review=htmlspecialchars(strip_tags($_POST['timeline_for_nra_review']));
        $timeline_for_nra_approval=htmlspecialchars(strip_tags($_POST['timeline_for_nra_approval']));
        $timeline_for_ct_authorization=htmlspecialchars(strip_tags($_POST['timeline_for_ct_authorization']));
        $delay_between_ec_approval_and_submission_nra=htmlspecialchars(strip_tags($_POST['delay_between_ec_approval_and_submission_nra']));
 
        // bind the parameters
        $stmt->bindParam(':title_of_the_clinical_trial', $title_of_the_clinical_trial);
        $stmt->bindParam(':study_number', $study_number);
        $stmt->bindParam(':name_of_sponsor', $name_of_sponsor);
        $stmt->bindParam(':phase', $phase);
        $stmt->bindParam(':type_of_product', $type_of_product);
        $stmt->bindParam(':date_of_submission_to_nra', $date_of_submission_to_nra);
        $stmt->bindParam(':date_of_submission_to_ec', $date_of_submission_to_ec);
        $stmt->bindParam(':parallel_submission_to_nra_and_ec', $parallel_submission_to_nra_and_ec);
        $stmt->bindParam(':review_type', $review_type);
        $stmt->bindParam(':nra_review_date', $nra_review_date);
        $stmt->bindParam(':ec_review_date', $ec_review_date);
        $stmt->bindParam(':ec_approval_date', $ec_approval_date);
        $stmt->bindParam(':nra_queries_submission_date', $nra_queries_submission_date);
        $stmt->bindParam(':query_type', $query_type);
        $stmt->bindParam(':response_date_to_nra_queries', $response_date_to_nra_queries);
        $stmt->bindParam(':nra_approval_date', $nra_approval_date);
        $stmt->bindParam(':nra_date_of_rejection', $nra_date_of_rejection);
        $stmt->bindParam(':date_of_authorization_or_rejection', $date_of_authorization_or_rejection);
        $stmt->bindParam(':main_reason_for_delay_in_approval', $main_reason_for_delay_in_approval);
        $stmt->bindParam(':timeline_for_ec_review', $timeline_for_ec_review);
        $stmt->bindParam(':timeline_for_ec_approval', $timeline_for_ec_approval);
        $stmt->bindParam(':timeline_for_nra_review', $timeline_for_nra_review);
        $stmt->bindParam(':timeline_for_nra_approval', $timeline_for_nra_approval);
        $stmt->bindParam(':timeline_for_ct_authorization', $timeline_for_ct_authorization);
        $stmt->bindParam(':delay_between_ec_approval_and_submission_nra', $delay_between_ec_approval_and_submission_nra);
        $stmt->bindParam(':id', $id);
         
        // Execute the query
        if($stmt->execute()){
            echo "<div class='alert alert-success'>Record was updated. <a href='internal.php' class=''>--->back to study Table</a></div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to update record. Please try again. <a href='internal.php' class=''>--->back to study Table</a></div>";
        }
         
    }
     
    // show errors
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
?>
        
<div class="bootstrap-iso">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>">
         <div class="form-group">
          <label class="control-label col-sm-2 requiredField" for="title_of_the_clinical_trial">
          Title of the clinical trial
          <a href="#" data-toggle="tooltip" title="Hier Text eingeben">*</a>
          </label>
          <div class="col-sm-10">
            <div class="input-group">
              <div class="input-group-addon">
              <i class="fa fa-pencil-square-o">
              </i>
              </div>
           <textarea class="form-control" cols="40" id="title_of_the_clinical_trial" name="title_of_the_clinical_trial"  rows="5" placeholder="..." type="text"><?php echo htmlspecialchars($title_of_the_clinical_trial, ENT_QUOTES);  ?></textarea>
          </div>
        </div>
      </div>
<br></br>

      <div class="form-group ">
       <label class="control-label col-sm-2" for="study_number">
        Study Number
       </label>
       <div class="col-sm-10">
        <div class="input-group">
         <div class="input-group-addon">
         <i class="fa fa-pencil-square-o">
         </i>
         </div>
        <input class="form-control" id="study_number" name="study_number" value="<?php echo htmlspecialchars($study_number, ENT_QUOTES);  ?>" type="text"/>
          <span class="help-block" id="hint_study_number">
        </div>
        kklsdkl sdojhs dfl l sdf
        </span>
      </div>
    </div>
<br></br>

    <div class="form-group ">
     <label class="control-label col-sm-2 requiredField" for="name_of_sponsor">
      Name of sponsor
       <a href="#" data-toggle="tooltip" title="Hier Text eingeben2">*</a>
    </label>
      <div class="col-sm-10">
       <div class="input-group">
        <div class="input-group-addon">
        <i class="fa fa-pencil-square-o">
        </i>
        </div>
      <input class="form-control" id="name_of_sponsor" name="name_of_sponsor" value="<?php echo htmlspecialchars($name_of_sponsor, ENT_QUOTES);  ?>" type="text"/>
      </div>
     </div>
    </div>
<br></br>

    <div class="form-group ">
     <label class="control-label col-sm-2" for="phase">
       Study Phase
     </label>
      <div class="col-sm-10">
       <div class="input-group">
        <div class="input-group-addon">
         <i class="fa fa-caret-square-o-down">
        </i>
        </div>
        <select class="select form-control" id="phase" name="phase" value="<?php echo htmlspecialchars($phase, ENT_QUOTES);  ?>">
       <option value="1">
          1
       </option>
       <option value="2">
          2
       </option>
       <option value="3">
          3
       </option>
       <option value="4">
          4
       </option>
       <option value="2a">
          2a
       </option>
       <option value="2b">
          2b
       </option>
      </select>
     </div>
    </div>
  </div>
<br></br>

            <div class="form-group ">
             <label class="control-label col-sm-2" for="type_of_product">
              Type of Product
             </label>
             <div class="col-sm-10">
               <div class="input-group">
                <div class="input-group-addon">
                 <i class="fa fa-pencil-square-o">
                 </i>
                </div>
              <input class="form-control" id="type_of_product" name="type_of_product" value="<?php echo htmlspecialchars($type_of_product, ENT_QUOTES);  ?>" type="text"/>
             </div>
            </div>
          </div>
            <br></br>

            <div class="form-group ">
             <label class="control-label col-sm-2" for="date_of_submission_to_nra">
              Date of submission to NRA
             </label>
             <div class="col-sm-10">
              <div class="input-group">
               <div class="input-group-addon">
                <i class="fa fa-calendar">
                </i>
               </div>
                  <input class="form-control" id="date_of_submission_to_nra" name="date_of_submission_to_nra" value="<?php echo htmlspecialchars($date_of_submission_to_nra, ENT_QUOTES);  ?>" type="text"/>
              </div>
             </div>
            </div>
            <br></br>

               <div class="form-group">
                <label class="control-label col-sm-2" for="date_of_submission_to_ec">
                 Date of submission to EC
                </label>
                <div class="col-sm-10">
                  <div class="input-group">
                   <div class="input-group-addon">
                    <i class="fa fa-calendar">
                    </i>
                  </div>
                  <input class="form-control" id="date_of_submission_to_ec" name="date_of_submission_to_ec" value="<?php echo htmlspecialchars($date_of_submission_to_ec, ENT_QUOTES);  ?>" type="text"/>
                 </div>
                </div>
               </div>
               <br></br>

               <div class="form-group">
                <label class="control-label col-sm-2 requiredField" for="Parallel_submission_to_NRA_and_EC">
                 Parallel submission to NRA and EC
                </label>
                <div class="col-sm-10">
                  <div class="input-group">
                   <div class="input-group-addon">
                    <i class="fa fa-pencil-square-o">
                    </i>
                   </div>
                 <input class="form-control" id="parallel_submission_to_nra_and_ec" name="parallel_submission_to_nra_and_ec" value="<?php echo htmlspecialchars($parallel_submission_to_nra_and_ec, ENT_QUOTES);  ?>" type="text"/>
                </div>
               </div>
             </div>
               <br></br>

               <div class="form-group">
                <label class="control-label col-sm-2 requiredField" for="Review_type">
                 Review type
                </label>
                <div class="col-sm-10">
                  <div class="input-group">
                   <div class="input-group-addon">
                    <i class="fa fa-pencil-square-o">
                    </i>
                   </div>
                 <input class="form-control" id="review_type" name="review_type" value="<?php echo htmlspecialchars($review_type, ENT_QUOTES);  ?>" type="text"/>
                </div>
               </div>
             </div>
               <br></br>

               <div class="form-group">
                <label class="control-label col-sm-2" for="nra_review_date">
                 NRA review date
                </label>
                <div class="col-sm-10">
                    <div class="input-group">
                     <div class="input-group-addon">
                      <i class="fa fa-calendar">
                        </i>
               </div>
               <input class="form-control" id="nra_review_date" name="nra_review_date" value="<?php echo htmlspecialchars($nra_review_date, ENT_QUOTES);  ?>" type="text"/>
              </div>
             </div>
            </div>
            <br></br>

               <div class="form-group">
                <label class="control-label col-sm-2 " for="ec_review_date">
                 EC review date
                </label>
                <div class="col-sm-10">
                  <div class="input-group">
                   <div class="input-group-addon">
                    <i class="fa fa-calendar">
                    </i>
               </div>
               <input class="form-control" id="ec_review_date" name="ec_review_date" value="<?php echo htmlspecialchars($ec_review_date, ENT_QUOTES);  ?>" type="text"/>
              </div>
             </div>
            </div>
            <br></br>

               <div class="form-group">
                <label class="control-label col-sm-2" for="ec_approval_date">
                 EC approval date
                </label>
                <div class="col-sm-10">
                  <div class="input-group">
                   <div class="input-group-addon">
                    <i class="fa fa-calendar">
                    </i>
               </div>
               <input class="form-control" id="ec_approval_date" name="ec_approval_date" value="<?php echo htmlspecialchars($ec_approval_date, ENT_QUOTES);  ?>" type="text"/>
              </div>
             </div>
            </div>
            <br></br>

               <div class="form-group">
                <label class="control-label col-sm-2" for="nra_queries_submission_date">
                 NRA queries submission date
                </label>
                <div class="col-sm-10">
                  <div class="input-group">
                   <div class="input-group-addon">
                    <i class="fa fa-calendar">
                    </i>
               </div>
               <input class="form-control" id="nra_queries_submission_date" name="nra_queries_submission_date" value="<?php echo htmlspecialchars($nra_queries_submission_date, ENT_QUOTES);  ?>" type="text"/>
              </div>
             </div>
            </div>
            <br></br>

               <div class="form-group">
                <label class="control-label col-sm-2 requiredField" for="Query_type">
                 Query type
                </label>
                <div class="col-sm-10">
                  <div class="input-group">
                   <div class="input-group-addon">
                    <i class="fa fa-pencil-square-o">
                    </i>
                   </div>
                 <input class="form-control" id="query_type" name="query_type" value="<?php echo htmlspecialchars($query_type, ENT_QUOTES);  ?>" type="text"/>
                </div>
              </div>
            </div>
              <br></br>

               <div class="form-group">
                <label class="control-label col-sm-2" for="response_date_to_nra_queries">
                 Response date to NRA queries
                </label>
                <div class="col-sm-10">
                  <div class="input-group">
                   <div class="input-group-addon">
                    <i class="fa fa-calendar">
                    </i>
              </div>
              <input class="form-control" id="response_date_to_nra_queries" name="response_date_to_nra_queries" value="<?php echo htmlspecialchars($response_date_to_nra_queries, ENT_QUOTES);  ?>" type="text"/>
             </div>
            </div>
           </div>
           <br></br>

              <div class="form-group">
               <label class="control-label col-sm-2" for="nra_approval_date">
                NRA approval date
               </label>
               <div class="col-sm-10">
                 <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-calendar">
                   </i>
              </div>
              <input class="form-control" id="nra_approval_date" name="nra_approval_date" value="<?php echo htmlspecialchars($nra_approval_date, ENT_QUOTES);  ?>" type="text"/>
             </div>
            </div>
           </div>
           <br></br>

              <div class="form-group">
               <label class="control-label col-sm-2" for="nra_date_of_rejection">
                NRA date of rejection
               </label>
               <div class="col-sm-10">
                 <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-calendar">
                   </i>
              </div>
              <input class="form-control" id="nra_date_of_rejection" name="nra_date_of_rejection" value="<?php echo htmlspecialchars($nra_date_of_rejection, ENT_QUOTES);  ?>" type="text"/>
             </div>
            </div>
           </div>
           <br></br>

              <div class="form-group">
               <label class="control-label col-sm-2" for="date_of_authorization_or_rejection">
                Date of authorization or rejection
               </label>
               <div class="col-sm-10">
                 <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-calendar">
                   </i>
              </div>
              <input class="form-control" id="date_of_authorization_or_rejection" name="date_of_authorization_or_rejection" value="<?php echo htmlspecialchars($date_of_authorization_or_rejection, ENT_QUOTES);  ?>" type="text"/>
             </div>
            </div>
           </div>
           <br></br>

              <div class="form-group">
               <label class="control-label col-sm-2 requiredField" for="main_reason_for_delay_in_approval">
                Main reason for delay in approval
               </label>
               <div class="col-sm-10">
                 <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-pencil-square-o">
                   </i>
                  </div>
                <textarea class="form-control" cols="40" id="main_reason_for_delay_in_approval" name="main_reason_for_delay_in_approval" placeholder="..." rows="5" type="text"><?php echo htmlspecialchars($main_reason_for_delay_in_approval, ENT_QUOTES);  ?></textarea>
               </div>
              </div>
            </div>
              <br></br>

              <div class="form-group">
               <label class="control-label col-sm-2 requiredField" for="timeline_for_ec_review">
                Timeline for EC review
               </label>
               <div class="col-sm-10">
                 <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-pencil-square-o">
                   </i>
                  </div>
                <input class="form-control" id="timeline_for_ec_review" name="timeline_for_ec_review" value="<?php echo htmlspecialchars($timeline_for_ec_review, ENT_QUOTES);  ?>" type="text"/>
               </div>
              </div>
            </div>
              <br></br>

              <div class="form-group">
               <label class="control-label col-sm-2 requiredField" for="timeline_for_ec_approval">
                Timeline for EC approval
               </label>
               <div class="col-sm-10">
                 <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-pencil-square-o">
                   </i>
                  </div>
                <input class="form-control" id="timeline_for_ec_approval" name="timeline_for_ec_approval" value="<?php echo htmlspecialchars($timeline_for_ec_approval, ENT_QUOTES);  ?>" type="text"/>
               </div>
              </div>
            </div>
              <br></br>

              <div class="form-group">
               <label class="control-label col-sm-2 requiredField" for="timeline_for_nra_review">
                Timeline for NRA review
               </label>
               <div class="col-sm-10">
                 <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-pencil-square-o">
                   </i>
                  </div>
                <input class="form-control" id="timeline_for_nra_review" name="timeline_for_nra_review" value="<?php echo htmlspecialchars($timeline_for_nra_review, ENT_QUOTES);  ?>" type="text"/>
               </div>
              </div>
            </div>
              <br></br>

              <div class="form-group">
               <label class="control-label col-sm-2 requiredField" for="timeline_for_NRA_approval">
                Timeline for NRA approval
               </label>
               <div class="col-sm-10">
                 <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-pencil-square-o">
                   </i>
                  </div>
                <input class="form-control" id="timeline_for_nra_approval" name="timeline_for_nra_approval" value="<?php echo htmlspecialchars($timeline_for_nra_approval, ENT_QUOTES);  ?>" type="text"/>
               </div>
              </div>
            </div>
              <br></br>

              <div class="form-group">
               <label class="control-label col-sm-2 requiredField" for="timeline_for_ct_authorization">
                Timeline for ct authorization
               </label>
               <div class="col-sm-10">
                 <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-pencil-square-o">
                   </i>
                  </div>
                <input class="form-control" id="timeline_for_ct_authorization" name="timeline_for_ct_authorization" value="<?php echo htmlspecialchars($timeline_for_ct_authorization, ENT_QUOTES);  ?>" type="text"/>
               </div>
              </div>
            </div>
              <br></br>

              <div class="form-group">
               <label class="control-label col-sm-2" for="delay_between_ec_approval_and_submission_nra">
                Delay between EC approval and submission to NRA
               </label>
               <div class="col-sm-10">
                 <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-pencil-square-o">
                   </i>
                  </div>
                <input class="form-control" id="delay_between_ec_approval_and_submission_nra" name="delay_between_ec_approval_and_submission_nra" value="<?php echo htmlspecialchars($delay_between_ec_approval_and_submission_nra, ENT_QUOTES);  ?>" type="text"/>
               </div>
              </div>
            </div>
              <br></br>

              <div class="form-group">
               <label class="control-label col-sm-2 requiredField" for="country">
                Country
               </label>
               <div class="col-sm-10">
                 <div class="input-group">
                  <div class="input-group-addon">
                   <i class="fa fa-map-marker">
                   </i>
               </div>
                <input id='disabledInput' placeholder='<?php echo htmlentities($user['country']); ?>' type='text' name='country' id='country' class='form-control' disabled/>
              </div>
             </div>
             <br></br>

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

</form>
</div>  
</div> <!-- end .container -->

    <?php 
        include("templates/footer.inc.php")
    ?>
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="date_of_submission_to_nra"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
      })
</script>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="date_of_submission_to_ec"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
      })
</script>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="nra_review_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
      })
</script>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="ec_review_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
      })
</script>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="ec_approval_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
      })
</script>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="nra_queries_submission_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
      })
</script>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="response_date_to_nra_queries"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
      })
</script>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="nra_approval_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
      })
</script>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="nra_date_of_rejection"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
      })
</script>

<script>
    $(document).ready(function(){
        var date_input=$('input[name="date_of_authorization_or_rejection"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
      })
</script>


</body>
</html>