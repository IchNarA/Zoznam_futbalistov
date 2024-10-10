<?php
require_once('spojenie.php');
$zaznamy_na_stranku = 5;
$stranka = isset($_GET['stranka']) ? $_GET['stranka'] : 1;
$offset = ($stranka - 1) * $zaznamy_na_stranku;
if (isset($_GET['vyhladavanieButton'])) {
    $search = $_GET['vyhladavanie'];
    $query = "SELECT * from zoznam_futbalistov WHERE Priezvisko LIKE '%$search%' ORDER BY Priezvisko ASC LIMIT $zaznamy_na_stranku OFFSET $offset";
} else {
    $query = "SELECT * FROM zoznam_futbalistov ORDER BY Priezvisko ASC LIMIT $zaznamy_na_stranku OFFSET $offset";
}

$sql = mysqli_query($con, $query);

if (!$sql) {
    echo "Doslo k chybe pri vykonavani SQL dotazu!";
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Zoznam futbalistov</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <header>
            <h2>Zoznam futbalistov</h2>
        </header>
        <div class="Pozadie">
            <img src="pozadie.jpg" alt="Pozadie" class="Rozmazane_pozadie">
            <div class="Zoznam_futbalistov_tabulka">
                <form action="Futbalisti.php" method="GET">
                    <div class="vyhladavanie_sekcia">
                        <input type="text" id="vyhladavanie" name="vyhladavanie" placeholder="Vyhľadávať">
                        <button id="vyhladavanieButton" type="submit" name="vyhladavanieButton">Vyhľadať</button>
                        <a href="new.php"><button type="button" id="pridatButton">Pridať</button></a>
                    </div>
                </form>

                <table class="Zoznam_futbalistov">
                    <thead>
                        <tr>
                            <th>Meno</th>
                            <th>Priezvisko</th>
                            <th>Plat(v mil)</th>
                            <th>Pozícia</th>
                            <th>Upraviť</th>
                            <th>Zmazať</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($sql)) {
                            $id = $row["id"];
                            $meno = $row["Meno"];
                            $priezvisko = $row["Priezvisko"];
                            $plat = $row["Plat"];
                            $pozicia = $row["Pozicia"];
                            echo "<tr>";
                            echo "<td>$meno</td>";
                            echo "<td>$priezvisko</td>";
                            echo "<td>$plat</td>";
                            echo "<td>$pozicia</td>";
                            echo '<td><a href="edit.php?id=' . $id . '"><img src="Btn_edit.png" class="edit_btn normal"></a></td>';
                            echo '<td><a href="delete.php?id=' . $id . '"><img src="Btn_drop.png" class="delete_btn normal"></a></td>';
                            echo "</tr>";
                        }
                        ?>
                    </tbody>

                </table>
                <div class="strankovanie">
                    <?php
                    $celkovy_pocet_zaznamov_query = isset($search) ? "SELECT COUNT(*) AS pocet FROM zoznam_futbalistov WHERE Priezvisko LIKE '%$search%'" : "SELECT COUNT(*) AS pocet FROM zoznam_futbalistov";
                    $pocet_sql = mysqli_query($con, $celkovy_pocet_zaznamov_query);
                    $pocet_zaznamov = mysqli_fetch_assoc($pocet_sql)['pocet'];

                    $celkovy_pocet_stranok = ceil($pocet_zaznamov / $zaznamy_na_stranku);



                    if ($stranka > 1) {
                        $predchadzajuca_stranka = $stranka - 1;
                        echo "<a href='Futbalisti.php?stranka=$predchadzajuca_stranka' class='sipka2'>&#10094</a> ";
                    }

                    if ($stranka < $celkovy_pocet_stranok) {
                        $nasledujuca_stranka = $stranka + 1;
                        echo "<a href='Futbalisti.php?stranka=$nasledujuca_stranka' class='sipka2'>&#10095</a> ";
                    }
                    ?>
                </div>

            </div>

        </div>

    </body>

    </html>
    <?php
}
?>