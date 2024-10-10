<?php
require_once('spojenie.php');

$meno = $_GET['meno'];
$priezvisko = $_GET['priezvisko'];
$plat = $_GET['plat'];
$pozicia = $_GET['pozicia'];




$sql = MySQLi_Query($con, "INSERT INTO zoznam_futbalistov VALUES (null,'$meno','$priezvisko',$plat,'$pozicia')");
if (!$sql):
    echo "Doslo k chybe pri vytvarani SQL dotazu 1 !";
else:
    ?>
    <meta http-equiv="refresh" content="0 Futbalisti.php">
    <?php
endif;
?>