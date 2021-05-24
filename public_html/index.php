<?php
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

Sesija::kreirajSesiju();
$_SESSION['id'] = '';

if(empty($_SERVER['HTTP_REFERER']) && isset($_SESSION['uloga']) && $_SESSION['uloga'] < 2) {
    header("Location: ./galerija.php");
}
if(empty($_SERVER['HTTP_REFERER']) && !isset($_SESSION['uloga'])) {
    header("Location: ./obrasci/prijava.php");
}

$ispis = getTableData();

function getTableData()
{

    $veza = new Baza();
    $veza->spojiDB();

    $upit = "SELECT *FROM `DZ4_obrazac`";

    $rezultat = $veza->selectDB($upit);
    $podaci = '';

    $a = 0;
    while (($red = mysqli_fetch_array($rezultat))) {
        $id = $red['id_obrazac'];
        $datum = $red['datum'];
        $vrijeme = $red['vrijeme'];
        $tim = $red['tim'];
        $primarna_pozicija = $red['primarna_pozicija'];
        $sekundarna_pozicija = $red['sekundarna_pozicija'];
        $ime = $red['ime'];
        $prezime = $red['prezime'];
        $golovi = $red['golovi'];
        $dribling = $red['dribling'];
        $asistencije = $red['asistencije'];
        $ocjena = $red['ocjena'];

        $podaci .= "<tr><td><form novalidate method=\"post\" action=\"./obrasci/obrazac.php\"><button type=\"submit\" name=\"id\" class=\"unstyled-button\" value=\"$id\">$id</button></form></td>"
                ."<td>$tim</td><td>$ime</td><td>$prezime</td>"
                . "<td><button type=\"submit\" name=\"submit\" class=\"unstyled-button load\" value=\"$id\">Detalji</button></td></tr>\n";

        $a++;
    }

    return $podaci;
}

?>

<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Početna</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Početna stranica" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="30.3.2021. Početna stranica web stranice, ključne riječi: početna, sport, novosti" />
    <link rel="stylesheet" href="./css/tskobic.css" />
    <!--<link
            rel="stylesheet"
            href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"
        />-->
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Početna</a>
        <?php
            include './meni.php';
        ?>

        <section aria-label="social networks" class="social-icons">
            <img class="social-icon m-l-sm" src="./multimedija/images/facebook.png" alt="facebook" />
            <img class="social-icon m-l-sm" src="./multimedija/images/instagram.png" alt="instagram" />
            <a href="./rss.php" target="_blank"><img class="social-icon m-l-sm" src="./multimedija/images/rss.png" alt="rss" /></a>
        </section>
    </header>
    <main id="content">
        <section aria-label="statistics" class="box box-scrollable centered center-content">
            <table class="table">
                <thead class="table__head table__head--dark">
                    <tr>
                        <th>ID</th>
                        <th>Tim</th>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Detalji</th>
                    </tr>
                </thead>
                <tbody class="table__body">
                    <?php
                    echo $ispis;
                    ?>
                </tbody>
            </table>
        </section>
        <div class="box box-scrollable centered center-content m-t-md rowdata"></div>
    </main>
    <footer class="box-fluid footer m-t-md">
        <div>
            <a href="./autor.html">Toni Škobić</a>
            <p>&copy; 2021 T. Škobić</p>
        </div>
        <section aria-label="validators">
            <a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/tskobic/" class="m-l-sm">
                <img src="./multimedija/images/HTML5.png" alt="html5" />
            </a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_04/tskobic/css/tskobic.css" class="m-l-sm">
                <img src="./multimedija/images/css3.png" alt="css3" />
            </a>
        </section>
    </footer>

    <script src="./javascript/podaci.js"></script>
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script
            type="text/javascript"
            src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"
        ></script>
        <script src="./javascript/tskobic_jquery.js"></script>-->
</body>

</html>