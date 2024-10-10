<?php
require_once('spojenie.php');

$id = $_GET['id'];

$query = "SELECT * from zoznam_futbalistov where ID=$id";
$sql_predmet = MySQLi_Query($con, $query);
if (!$sql_predmet):
    echo "Doslo k chybe pri vytvarani SQL dotazu 1 !";
else:
    $row = mysqli_fetch_array($sql_predmet, MYSQLI_ASSOC);
    $meno = $row["Meno"];
    $priezvisko = $row["Priezvisko"];
    $plat = $row["Plat"];
    $pozicia = $row["Pozicia"];
endif;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <h2>
            <?php echo 'Upraviť: ' . $meno; ?>
        </h2>
    </header>
    <div class="column">
        <div class="header">
            <h3>Formulár pre upravenie</h3>
        </div>
        <form method="get" name="form6" action="up.php">
            <input type="text" id="meno" name="meno" placeholder="Meno" required>
            <input type="text" id="priezvisko" name="priezvisko" placeholder="Priezvisko" required>
            <input type="number" id="plat" name="plat" min="1" max="99999" placeholder="Plat" required>
            <select name="pozicia" id="pozicia" required>
                <option value="" disabled selected>Vybrať pozíciu</option>
                <option value="Útočník">Útočník</option>
                <option value="Ľavý krídelník">Ľavý krídelník</option>
                <option value="Pravý krídelník">Pravý krídelník</option>
                <option value="Stopér">Stopér</option>
                <option value="Stredopoliar">Stredopoliar</option>
                <option value="Ľavý bek">Ľavý bek</option>
                <option value="Pravý bek">Pravý bek</option>
            </select>
            <input type="Submit" name="Submit_button" value="Upraviť" style="margin-left:160px;">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </form>
        <a href="Futbalisti.php"><img src="back_button.png" alt="Sipka_späť"></a>
    </div>
</body>

</html>