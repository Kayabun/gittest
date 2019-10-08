<?php
//session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
$user = check_user();
 ?>

<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>

</head>
<body>

            <h2>Alle registrierten User</h2>
            <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Rolle</th>
                    <th>E-Mail</th>
                </tr>
            </thead>
                <tbody>
                    <?php

                    $statement = $pdo->prepare("SELECT * FROM users ORDER BY id");
                    $result = $statement->execute();
                    $count = 1;
                    while($row = $statement->fetch()) {
                            echo "<tr>";
                            echo "<td>".$count++."</td>";
                            echo "<td>".$row['vorname']."</td>";
                            echo "<td>".$row['nachname']."</td>";
                            echo "<td>".$row['role']."</td>";
                            echo '<td><a href="mailto:'.$row['email'].'">'.$row['email'].'</a></td>';
                            echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>


<?php
// include database connection
include 'inc/config.inc.php';

?>


</body>
</html>
