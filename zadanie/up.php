<?php
require_once('spojenie.php');


$id = $_GET['id'];
$meno = $_GET['meno'];
$priezvisko = $_GET['priezvisko'];
$plat = $_GET['plat'];
$pozicia = $_GET['pozicia'];


$query = "UPDATE zoznam_futbalistov SET Meno='$meno', Priezvisko='$priezvisko', Plat='$plat', Pozicia='$pozicia' WHERE id=$id";


$sql_predmet = mysqli_query($con, $query);

if (!$sql_predmet):
    echo "Doslo k chybe pri vytvarani SQL dotazu 1 !";
else:
    ?>
    <meta http-equiv="refresh" content="0 Futbalisti.php">
    <?php
endif;
?>