<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sklep papierniczy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>W naszym sklepie internetowym kupisz najtaniej</h1>
    </header>
    <div class="content">
        <div class="left">
            <h3>Promocja 15% obejmuje artykuły:</h3>
            <ul>
                <?php
                    $mysqli = mysqli_connect("localhost", "root", "", "sklep");

                    if ($mysqli == false) {
                        return;
                    }

                    $mysqli_result = $mysqli->query("SELECT `nazwa` FROM `towary` WHERE `promocja` = 1;");

                    foreach ($mysqli_result as $row) {
                        $nazwa = $row['nazwa'];
                        echo "<li>$nazwa</li>";
                    }

                    $mysqli->close();
                ?>
            </ul>
        </div>
        <div class="center">
            <h3>Cena wybranego artykułu w promocji</h3>
            <form action="index.php" method="post">
                <label>
                    <select name="promocja" id="promocja">
                        <?php

                        $mysqli = mysqli_connect("localhost", "root", "", "sklep");

                        if ($mysqli == false) {
                            return;
                        }

                        $mysqli_result = $mysqli->query("SELECT `nazwa` FROM `towary` WHERE `promocja` = 1;");

                        foreach ($mysqli_result as $row) {
                            $nazwa = $row['nazwa'];
                            echo "<option>$nazwa</option>";
                        }

                        $mysqli->close();

                        ?>
                    </select>
                </label>
                <input type="submit">
            </form>
            <?php

            if ($_SERVER['REQUEST_METHOD'] != 'POST' && isset($_POST['promocja'])) {
                $promocja = $_POST['promocja'];
                $query = "SELECT `cena` FROM `towary` WHERE `nazwa` = \"$promocja\";";

                $mysqli = mysqli_connect("localhost", "root", "", "sklep");

                if ($mysqli == false) {
                    return;
                }

                $mysqli_result = $mysqli->query($query);
                $result = $mysqli_result[0]["cena"] * 0.85;

                $round = round($result, 2);
                echo $round;

                $mysqli->close();
            }

            ?>
        </div>
        <div class="right">
            <h3>Kontakt</h3>
            <p>
                telefon 123123123
                <br>
                e-mail: <a href="mailto:bok@sklep.pl"></a> bok@sklep.pl
            </p>
            <img src="images/promocja2.png" alt="promocja">
        </div>
    </div>

    <footer>
        <h4>Autor strony %PESEL%</h4>
    </footer>
</body>
</html>
