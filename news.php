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
                    <li>
                        <a href="internal.php" >Startseite</a>
                    </li>
                    <li class="active">
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
                      <h2>Betriebsinterne Ankündigungen</h2>
                      <p>26.09.2019</p>
                        <p>
                          Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.

                          Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.

                          Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.

                          Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer
                        </p>
              </div>

            </div>
        </div>

        <?php
            include("templates/footer.inc.php")
        ?>

    </body>
</html>
