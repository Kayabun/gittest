<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
//var_dump($user['role']);
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

                <div class="navbar navbar-default">
                    <div class="container-fluid">
                <?php
                if ($user['role'] == "admin") {
                  //include();
                }else {
                  //include("");
                }
                ?>
              </div>
          </div>

            </div>
        </div>

        <?php
            include("templates/footer.inc.php")
        ?>

    </body>
</html>
