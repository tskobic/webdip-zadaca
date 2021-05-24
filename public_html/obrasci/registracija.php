<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

Sesija::kreirajSesiju();
$_SESSION['id'] = '';

$autenticiran;

if (isset($_POST['submit'])) {
    $greska = '';
    $poruka = '';
    foreach ($_POST as $k => $v) {
        if (($k !== 'name' && $k !== 'surname') && empty($v)) {
            $greska .= 'Nije popunjeno: ' . $k . '<br>';
        }
    }
    if ($_POST['password'] !== $_POST['confirm_password']) {
        $greska .= 'Lozinke se ne podudaraju! <br>';
    }
    if (empty($greska)) {
        $veza = new Baza();
        $veza->spojiDB();

        if ($_POST['name'] === '') {
            $ime = 'NULL';
        } else {
            $ime = $_POST['name'];
        }

        if ($_POST['surname'] === '') {
            $prezime = 'NULL';
        } else {
            $prezime = $_POST['surname'];
        }

        $korime = $_POST['username'];
        $email = $_POST['email'];
        $lozinka = $_POST['password'];
        $salt = sha1(time());
        $kriptirano = hash("sha256", $salt . "--" . $lozinka);

        $upit = "INSERT INTO dz4_korisnik "
            . "(id_korisnik, id_uloga, ime, prezime, korisnicko_ime, email, lozinka, lozinka_sha256) "
            . "VALUES "
            . "(NULL, '1', '{$ime}', '{$prezime}', '{$korime}', '{$email}', '{$lozinka}', '{$kriptirano}')";

        $rezultat = $veza->updateDB($upit);

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
    <title>Registracija</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Registracija" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="30.3.2021. Stranica registracije, ključne riječi: registracija, sport, novosti" />
    <link rel="stylesheet" href="../css/tskobic.css" />
    <!--<link
            rel="stylesheet"
            href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
        />-->
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Registracija</a>
        <?php
            include '../meni.php';
        ?>

        <section aria-label="social networks" class="social-icons">
            <img class="social-icon m-l-sm" src="../multimedija/images/facebook.png" alt="facebook" />
            <img class="social-icon m-l-sm" src="../multimedija/images/instagram.png" alt="instagram" />
            <a href="../rss.php" target="_blank"><img class="social-icon m-l-sm" src="../multimedija/images/rss.png" alt="rss" /></a>
        </section>
    </header>
    <main id="content" class="box">
        <form novalidate class="form centered" method="post" action="">
            <div id="greska" style="color:red">
                <?php
                if (isset($greska)) {
                    echo "<p>$greska</p>";
                }
                ?>
            </div>
            <label for="name">Ime:</label>
            <input type="text" name="name" id="name" class="name" />

            <label for="surname">Prezime:</label>
            <input type="text" name="surname" id="surname" class="surname" />

            <label for="username">Korisničko ime:</label>
            <input type="text" name="username" id="username" class="username" />

            <label for="e-mail">Elektronička pošta:</label>
            <input type="email" name="email" id="email" />

            <label for="password">Lozinka:</label>
            <input type="password" name="password" id="password" class="password" />

            <label for="confirm_password">Potvrda lozinke:</label>
            <input type="password" name="confirm password" id="confirm_password" class="confirm_password" />

            <!--<label for="datetime">Datum i vrijeme:</label>
                <input type="text" name="datetime" id="datetime" class="datetime" />-->

            <button type="submit" name="submit" class="button button--primary m-t-md" value="Registriraj se">
                Registriraj se
            </button>
        </form>
    </main>
    <footer class="box-fluid footer m-t-md">
        <div>
            <a href="../autor.html">Toni Škobić</a>
            <p>&copy; 2021 T. Škobić</p>
        </div>
        <section aria-label="validation references">
            <a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/tskobic/obrasci/registracija.html" class="m-l-sm">
                <img src="../multimedija/images/HTML5.png" alt="html5" />
            </a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_04/tskobic/css/tskobic.css" class="m-l-sm">
                <img src="../multimedija/images/css3.png" alt="css3" />
            </a>
        </section>
    </footer>

    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"
        ></script>
        <script src="../javascript/tskobic_jquery.js"></script>-->
</body>

</html>