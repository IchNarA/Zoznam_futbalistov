<?php
require_once('spojenie.php');


$id = $_GET['id'];


$query = "DELETE FROM zoznam_futbalistov WHERE id=$id";


$sql_predmet = mysqli_query($con, $query);

if (!$sql_predmet):
    echo "Doslo k chybe pri vytvarani SQL dotazu 1 !";
else:
    ?>
    <meta http-equiv="refresh" content="0 Futbalisti.php">
    <?php
endif;
?>