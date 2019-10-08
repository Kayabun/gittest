<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

include("templates/header.inc.php");
?>
<div class="wrapper">
		<!-- Sidebar Holder -->
		<nav id="sidebar">
				<div class="sidebar-header">
						<h3>Mitarbeiter Bereich</h3></h3>
				</div>

				<ul class="list-unstyled components">
						<!-- <p>Navigation</p> -->
						<li>
								<a href="internal.php" >Startseite</a>
						</li>
						<li>
								<a href="news.php">News</a>
						</li>
						<li>
								<a href="#">Kontakt</a>
						</li>
						<li class="active">
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

				<nav class="navbar navbar-default">
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

<?php
if(isset($_GET['save'])) {
	$save = $_GET['save'];

	if($save == 'personal_data') {
		$vorname = trim($_POST['vorname']);
		$nachname = trim($_POST['nachname']);

		if($vorname == "" || $nachname == "") {
			$error_msg = "Bitte Vor- und Nachname ausfüllen.";
		} else {
			$statement = $pdo->prepare("UPDATE users SET vorname = :vorname, nachname = :nachname, updated_at=NOW() WHERE id = :userid");
			$result = $statement->execute(array('vorname' => $vorname, 'nachname'=> $nachname, 'userid' => $user['id'] ));

			$success_msg = "Daten erfolgreich gespeichert.";
		}
	} else if($save == 'email') {
		$passwort = $_POST['passwort'];
		$email = trim($_POST['email']);
		$email2 = trim($_POST['email2']);

		if($email != $email2) {
			$error_msg = "Die eingegebenen E-Mail-Adressen stimmten nicht überein.";
		} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error_msg = "Bitte eine gültige E-Mail-Adresse eingeben.";
		} else if(!password_verify($passwort, $user['passwort'])) {
			$error_msg = "Bitte korrektes Passwort eingeben.";
		} else {
			$statement = $pdo->prepare("UPDATE users SET email = :email WHERE id = :userid");
			$result = $statement->execute(array('email' => $email, 'userid' => $user['id'] ));

			$success_msg = "E-Mail-Adresse erfolgreich gespeichert.";
		}

	} else if($save == 'passwort') {
		$passwortAlt = $_POST['passwortAlt'];
		$passwortNeu = trim($_POST['passwortNeu']);
		$passwortNeu2 = trim($_POST['passwortNeu2']);

		if($passwortNeu != $passwortNeu2) {
			$error_msg = "Die eingegebenen Passwörter stimmten nicht überein.";
		} else if($passwortNeu == "") {
			$error_msg = "Das Passwort darf nicht leer sein.";
		} else if(!password_verify($passwortAlt, $user['passwort'])) {
			$error_msg = "Bitte korrektes Passwort eingeben.";
		} else {
			$passwort_hash = password_hash($passwortNeu, PASSWORD_DEFAULT);

			$statement = $pdo->prepare("UPDATE users SET passwort = :passwort WHERE id = :userid");
			$result = $statement->execute(array('passwort' => $passwort_hash, 'userid' => $user['id'] ));

			$success_msg = "Passwort erfolgreich gespeichert.";
		}

	}
}

$user = check_user();

?>

<nav class="navbar navbar-default">
		<div class="container-fluid">
				<h1>Einstellungen</h1>
		</div>
</nav>
<?php
if(isset($success_msg) && !empty($success_msg)):
?>
	<div class="alert alert-success">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  	<?php echo $success_msg; ?>
	</div>
<?php
endif;
?>

<?php
if(isset($error_msg) && !empty($error_msg)):
?>
	<div class="alert alert-danger">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	  	<?php echo $error_msg; ?>
	</div>
<?php
endif;
?>

<br>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="nav-item"><a class="nav-link active" href="#data" aria-controls="home" role="tab" data-toggle="tab">Persönliche Daten</a></li>
    <li role="presentation" class="nav-item"><a class="nav-link" href="#email" aria-controls="profile" role="tab" data-toggle="tab">E-Mail</a></li>
    <li role="presentation" class="nav-item"><a class="nav-link" href="#passwort" aria-controls="messages" role="tab" data-toggle="tab">Passwort</a></li>
  </ul>

  <!-- Persönliche Daten-->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="data">
    	<br>
    	<form action="?save=personal_data" method="post" class="form-horizontal">
    		<div class="form-group">
    			<label for="inputVorname" class="col-sm-2 control-label">Vorname</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputVorname" name="vorname" type="text" value="<?php echo htmlentities($user['vorname']); ?>" required>
    			</div>
    		</div>

    		<div class="form-group">
    			<label for="inputNachname" class="col-sm-2 control-label">Nachname</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputNachname" name="nachname" type="text" value="<?php echo htmlentities($user['nachname']); ?>" required>
    			</div>
    		</div>

    		<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-primary">Speichern</button>
			    </div>
			</div>
    	</form>
    </div>

    <!-- Änderung der E-Mail-Adresse -->
    <div role="tabpanel" class="tab-pane" id="email">
    	<br>
    	<p>Zum Änderen deiner E-Mail-Adresse gib bitte dein aktuelles Passwort sowie die neue E-Mail-Adresse ein.</p>
    	<form action="?save=email" method="post" class="form-horizontal">
    		<div class="form-group">
    			<label for="inputPasswort" class="col-sm-2 control-label">Passwort</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputPasswort" name="passwort" type="password" required>
    			</div>
    		</div>

    		<div class="form-group">
    			<label for="inputEmail" class="col-sm-2 control-label">E-Mail</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputEmail" name="email" type="email" value="<?php echo htmlentities($user['email']); ?>" required>
    			</div>
    		</div>


    		<div class="form-group">
    			<label for="inputEmail2" class="col-sm-2 control-label">E-Mail (wiederholen)</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputEmail2" name="email2" type="email"  required>
    			</div>
    		</div>

    		<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-primary">Speichern</button>
			    </div>
			</div>
    	</form>
    </div>

    <!-- Änderung des Passworts -->
    <div role="tabpanel" class="tab-pane" id="passwort">
    	<br>
    	<p>Zum Änderen deines Passworts gib bitte dein aktuelles Passwort sowie das neue Passwort ein.</p>
    	<form action="?save=passwort" method="post" class="form-horizontal">
    		<div class="form-group">
    			<label for="inputPasswort" class="col-sm-2 control-label">Altes Passwort</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputPasswort" name="passwortAlt" type="password" required>
    			</div>
    		</div>

    		<div class="form-group">
    			<label for="inputPasswortNeu" class="col-sm-2 control-label">Neues Passwort</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputPasswortNeu" name="passwortNeu" type="password" required>
    			</div>
    		</div>


    		<div class="form-group">
    			<label for="inputPasswortNeu2" class="col-sm-2 control-label">Neues Passwort (wiederholen)</label>
    			<div class="col-sm-10">
    				<input class="form-control" id="inputPasswortNeu2" name="passwortNeu2" type="password"  required>
    			</div>
    		</div>

    		<div class="form-group">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-primary">Speichern</button>
			    </div>
			</div>
    	</form>
    </div>
  </div>


</div>

<?php
include("templates/footer.inc.php")
?>
