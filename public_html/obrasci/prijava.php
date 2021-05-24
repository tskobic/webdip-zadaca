<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

Sesija::kreirajSesiju();
$_SESSION['id'] = '';

if(empty($_SERVER['HTTP_REFERER']) && isset($_SESSION['uloga']) && $_SESSION['uloga'] >= 1) {
    header("Location: ../galerija.php");
}

$autenticiran;

if (isset($_GET['submit'])) {
    $greska = "";
    $poruka = "";
    foreach ($_GET as $k => $v) {
        if (empty($v)) {
            $greska .= "Nije popunjeno: " . $k . "<br>";
        }
    }
    if (empty($greska)) {
        $veza = new Baza();
        $veza->spojiDB();

        $korime = $_GET['username'];
        $lozinka = $_GET['password'];

        $upit = "SELECT *FROM `DZ4_korisnik` WHERE "
            . "`korisnicko_ime`='{$korime}' AND "
            . "`lozinka`='{$lozinka}'";

        $rezultat = $veza->selectDB($upit);

        $autenticiran = false;
        while ($red = mysqli_fetch_array($rezultat)) {
            if ($red) {
                $autenticiran = true;
                $tip = $red["id_uloga"];
                $email = $red["email"];
            }
        }

        if ($autenticiran) {
            $poruka = 'Uspješna prijava!';

            setcookie("autenticiran", $korime, false, '/', false);

            Sesija::kreirajKorisnika($korime, $tip);
            header("Location: ../galerija.php");
        } else {
            $poruka = 'Neuspješna prijava, pokušajte ponovo!';
        }

        $veza->zatvoriDB();
    }
}
?>

<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Prijava</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Prijava" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="30.3.2021. Stranica O autoru web stranice, ključne riječi: prijava, sport, novosti" />
    <link rel="stylesheet" href="../css/tskobic.css" />
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Prijava</a>
        <?php
        include '../meni.php';
        ?>

        <section aria-label="social networks" class="social-icons">
            <img class="social-icon m-l-sm" src="../multimedija/images/facebook.png" alt="facebook" />
            <img class="social-icon m-l-sm" src="../multimedija/images/instagram.png" alt="instagram" />
            <a href="../rss.php" target="_blank"><img class="social-icon m-l-sm" src="../multimedija/images/rss.png" alt="rss" /></a>
        </section>
    </header>
    <main id="content">
        <form novalidate id="prijava" class="form centered" method="get" action="">
            <div id="greska" style="color:red">
                <?php
                if (isset($autenticiran)) {
                    if ($autenticiran == false) {
                        echo "<p>$poruka</p>";
                    }
                }
                ?>
            </div>
            <label for="username">Korisničko ime:</label>
            <input type="text" name="username" id="username" />

            <label for="password">Lozinka:</label>
            <input type="password" name="password" id="password" />

            <button type="submit" name="submit" class="button button--primary m-t-md" value="Prijavi se">
                Prijavi se
            </button>

            <div class="buttons">
                <button type="submit" name="submit" class="button button--primary m-t-md" value="Prijava korisnik" formaction="./prijava_tipka.php">
                    Prijava korisnik
                </button>

                <button type="submit" name="submit" class="button button--primary m-t-md" value="Prijava moderator" formaction="./prijava_tipka.php">
                    Prijava moderator
                </button>

                <button type="submit" name="submit" class="button button--primary m-t-md" value="Prijava admin" formaction="./prijava_tipka.php">
                    Prijava admin
                </button>
            </div>
        </form>
    </main>
    <footer class="box-fluid footer m-t-md">
        <div>
            <a href="../autor.html">Toni Škobić</a>
            <p>&copy; 2021 T. Škobić</p>
        </div>
        <section aria-label="validation references">
            <a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/tskobic/obrasci/prijava.html" class="m-l-sm">
                <img src="../multimedija/images/HTML5.png" alt="html5" />
            </a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_04/tskobic/css/tskobic.css" class="m-l-sm">
                <img src="../multimedija/images/css3.png" alt="css3" />
            </a>
        </section>
    </footer>
</body>

</html>