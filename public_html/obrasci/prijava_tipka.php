<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

Sesija::kreirajSesiju();

if(empty($_SERVER['HTTP_REFERER'])) {
    header("Location: ../galerija.php");
}

$autenticiran;

$greska = "";
$poruka = "";

$veza = new Baza();
$veza->spojiDB();
switch ($_GET['submit']) {
    case "Prijava korisnik":
        $korime = "korisnik";
        $lozinka = "korisnik";
        break;
    case "Prijava moderator":
        $korime = "moderator";
        $lozinka = "moderator";
        break;
    case "Prijava admin":
        $korime = "admin";
        $lozinka = "admin";
        break;
    default:
        break;
}


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
