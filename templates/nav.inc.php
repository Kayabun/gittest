<!--
  <nav>
    <ul>
      <li><a href="internal.php">Startseite</a></li>
      <?php
      //if (@$user['role'] == "admin") {
        ?><li><a style="color:red;" href="register.php">neuen User Registrieren</a></li><?php
        ?><li><a style="color:red;" href="#">Monatsabrechnung Verwalten</a></li><?php
        ?><li><a style="color:red;" href="#">Urlaubsantrag Verwalten</a></li><?php
      //}
      ?>
      <li><a href="settings.php">Settings</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>
  <?php
  // put your code here
  ?>
-->


  <!-- Custom styles for this template -->
<link href="css/simple-sidebar.css" rel="stylesheet">


  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container">
      <a class="navbar-brand" href="#">
            <img src="http://placehold.it/150x50?text=Logo" alt="">
          </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="nav navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="internal.php">Startseite
                  <span class="sr-only">(current)</span>
                </a>
          </li>
          <li class="nav-item settings">
            <a class="nav-link" href="settings.php">Mein Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Kontakt</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
          <?php
          if (@$user['role'] == "admin") {
            ?><li class="nav-item register"><a class="nav-link" style="color:red;" href="register.php">add User</a></li><?php
            ?><li class="nav-item m_abrechnung"><a class="nav-link" style="color:red;" href="m_abrechnung.php">M-Abrechnungen</a></li><?php
            ?><li class="nav-item create"><a class="nav-link" style="color:red;" href="create.php">U-Anträge</a></li><?php
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>


    <div class="d-flex" id="wrapper">

      <!-- Sidebar -->
      <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Start Bootstrap </div>
        <div class="list-group list-group-flush">
          <a href="#" class="list-group-item list-group-item-action bg-light">Dashboard</a>
          <a href="#" class="list-group-item list-group-item-action bg-light">Shortcuts</a>
          <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
          <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
          <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
          <a href="#" class="list-group-item list-group-item-action bg-light">Status</a>
        </div>
      </div>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
          <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
  </button>


  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
      $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
