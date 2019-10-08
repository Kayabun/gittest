<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
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
                    <li class="active">
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
                      <!--
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Einstellungen</a></li>
                            </ul>
                        </div>
                      -->
                    </div>
                </nav>
                <br>
                <br>

                    <div class="container-fluid">


<div class="registration-form col-sm-4">
<?php
if ($user['role'] == "admin") {
  ?><h1>Registrierung</h1><?php
  $showFormular = true;
}else {
  $showFormular = false;
  ?><p>Diese Seite ist für Sie nicht zugänglich.</p><?php
}

//$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
	$error = false;
	$vorname = trim($_POST['vorname']);
	$nachname = trim($_POST['nachname']);
	$email = trim($_POST['email']);
  $role = "user";
	$passwort = $_POST['passwort'];
	$passwort2 = $_POST['passwort2'];

	if(empty($vorname) || empty($nachname) || empty($email)) {
		echo 'Bitte alle Felder ausfüllen<br>';
		$error = true;
	}

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
		$error = true;
	}
	if(strlen($passwort) == 0) {
		echo 'Bitte ein Passwort angeben<br>';
		$error = true;
	}
	if($passwort != $passwort2) {
		echo 'Die Passwörter müssen übereinstimmen<br>';
		$error = true;
	}

	//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
	if(!$error) {
		$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
		$result = $statement->execute(array('email' => $email));
		$user = $statement->fetch();

		if($user !== false) {
			echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
			$error = true;
		}
	}

	//Keine Fehler, wir können den Nutzer registrieren
	if(!$error) {
		$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

		$statement = $pdo->prepare("INSERT INTO users (email, passwort, vorname, nachname, role) VALUES (:email, :passwort, :vorname, :nachname, :role)");
		$result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'vorname' => $vorname, 'nachname' => $nachname, 'role' => $role));

		if($result) {
			echo 'Du wurdest erfolgreich registriert. <a href="login.php">Zum Login</a>';
			$showFormular = false;
		} else {
			echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
		}
	}
}

if($showFormular) {
?>

<form action="?register=1" method="post">

<div class="form-group">
<label for="inputVorname">Vorname:</label>
<input type="text" id="inputVorname" size="40" maxlength="250" name="vorname" class="form-control" required>
</div>

<div class="form-group">
<label for="inputNachname">Nachname:</label>
<input type="text" id="inputNachname" size="40" maxlength="250" name="nachname" class="form-control" required>
</div>

<div class="form-group">
<label for="inputEmail">E-Mail:</label>
<input type="email" id="inputEmail" size="40" maxlength="250" name="email" class="form-control" required>
</div>
<!--
<div class="form-group">
<label for="inputCountry">Country:</label>
<input type="text" id="inputCountry" size="40" maxlength="250" name="country" class="form-control" required>
</div>
-->
<div class="form-group">
<label for="inputPasswort">Dein Passwort:</label>
<input type="password" id="inputPasswort" size="40"  maxlength="250" name="passwort" class="form-control" required>
</div>

<div class="form-group">
<label for="inputPasswort2">Passwort wiederholen:</label>
<input type="password" id="inputPasswort2" size="40" maxlength="250" name="passwort2" class="form-control" required>
</div>
<button type="submit" class="btn btn-lg btn-primary btn-block">Registrieren</button>
</form>

<?php
} //Ende von if($showFormular)


?>
</div>
</div>
</div>
</div>
<?php
include("templates/footer.inc.php")
?>
