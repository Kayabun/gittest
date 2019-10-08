<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//include("templates/header.inc.php");
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<?php

$error_msg = "";
if(isset($_POST['email']) && isset($_POST['passwort'])) {
	$email = $_POST['email'];
	$passwort = $_POST['passwort'];


	$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
	$result = $statement->execute(array('email' => $email));
	$user = $statement->fetch();


	//Überprüfung des Passworts
	if ($user !== false && password_verify($passwort, $user['passwort'])) {
		$_SESSION['userid'] = $user['id'];

		//Möchte der Nutzer angemeldet beleiben?
		if(isset($_POST['angemeldet_bleiben'])) {
			$identifier = random_string();
			$securitytoken = random_string();

			$insert = $pdo->prepare("INSERT INTO securitytokens (user_id, identifier, securitytoken) VALUES (:user_id, :identifier, :securitytoken)");
			$insert->execute(array('user_id' => $user['id'], 'identifier' => $identifier, 'securitytoken' => sha1($securitytoken)));
			setcookie("identifier",$identifier,time()+(3600*24*365)); //Valid for 1 year
			setcookie("securitytoken",$securitytoken,time()+(3600*24*365)); //Valid for 1 year
		}

                //verlinken auf intenal.php
		header("location: internal.php");

                //Countries/$country
                //$coutry = htmlentities($user['country']);
		//header("location: Countries/$coutry.php");
		exit;
	} else {
		$error_msg =  "E-Mail oder Passwort war ungültig<br><br>";
	}

}

$email_value = "";
if(isset($_POST['email']))
	$email_value = htmlentities($_POST['email']);

?>


<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Loginskript</title>

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

<div class="bg-image"></div>

	<div class="container bg-text">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h3 class="card-title text-center">Anmeldeformular</h3>

  <form action="login.php" method="post" class="form-signin">
      <br>
      <br>

<?php
if(isset($error_msg) && !empty($error_msg)) {
	echo $error_msg;
}
?>
	<div class="">
		<label for="inputEmail" class="sr-only">E-Mail</label>
		<input type="email" name="email" id="inputEmail" class="form-control" placeholder="E-Mail" value="<?php echo $email_value; ?>" required>
	</div>
	<br>
	<div class="">
		<label for="inputPassword" class="sr-only">Passwort</label>
		<input type="password" name="passwort" id="inputPassword" class="form-control" placeholder="Passwort" required>
	</div>

	<div class="checkbox">
	  <label>
		<input type="checkbox" value="remember-me" name="angemeldet_bleiben" value="1" checked> Angemeldet bleiben
	  </label>
	</div>

	<br>
	<br>
	<br>

	<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
	<br>
	<a href="passwortvergessen.php">Passwort vergessen</a>
  </form>

</div>
</div>
</div>
</div>
</div>




<?php
include("templates/footer.inc.php")
?>

<style media="screen">

:root {
  --input-padding-x: 1.5rem;
  --input-padding-y: .75rem;
}

body {

  #background: #007bff;
  #background: linear-gradient(to right, #0062E6, #33AEFF);
}

.bg-image {
	background-image: url("img/bg3.jpg");
	/* Add the blur effect */
	filter: blur(8px);
	-webkit-filter: blur(8px);
	transform: scale(1.0);
	/* Full height */
	height: 100%;
	margin:0px;
	/* Center and scale the image nicely */
	#background-position: fixed;
	background-repeat: no-repeat;
	-webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
	background-attachment: fixed;
}

.bg-text {
	position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 2;
}

.card-signin {
  border: 0;
  border-radius: 1rem;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.card-signin .card-title {
  margin-bottom: 2rem;
  font-weight: 300;
  font-size: 1.5rem;
}

.card-signin .card-body {
  padding: 2rem;
}

.form-signin {
  width: 100%;
}

.form-signin .btn {
  border-radius: 5rem;
  letter-spacing: .1rem;
  padding: 1rem;
  transition: all 0.2s;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}

.form-label-group input {
  height: auto;
  border-radius: 2rem;
}

.form-label-group>input,
.form-label-group>label {
  padding: var(--input-padding-y) var(--input-padding-x);
}

.form-label-group>label {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  margin-bottom: 0;
  /* Override default `<label>` margin */
  line-height: 1.5;
  color: #495057;
  border: 1px solid transparent;
  border-radius: .25rem;
  transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
  color: transparent;
}

.form-label-group input:-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-moz-placeholder {
  color: transparent;
}

.form-label-group input::placeholder {
  color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
  padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
  padding-bottom: calc(var(--input-padding-y) / 3);
}

.form-label-group input:not(:placeholder-shown)~label {
  padding-top: calc(var(--input-padding-y) / 3);
  padding-bottom: calc(var(--input-padding-y) / 3);
  font-size: 12px;
  color: #777;
}

.btn-google {
  color: white;
  background-color: #ea4335;
}

.btn-facebook {
  color: white;
  background-color: #3b5998;
}

/* Fallback for Edge
-------------------------------------------------- */

@supports (-ms-ime-align: auto) {
  .form-label-group>label {
    display: none;
  }
  .form-label-group input::-ms-input-placeholder {
    color: #777;
  }
}

/* Fallback for IE
-------------------------------------------------- */

@media all and (-ms-high-contrast: none),
(-ms-high-contrast: active) {
  .form-label-group>label {
    display: none;
  }
  .form-label-group input:-ms-input-placeholder {
    color: #777;
  }
}

</style>
