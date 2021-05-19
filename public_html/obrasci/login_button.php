<?php
//var_dump($GLOBALS);
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
//var_dump(__FILE__);
//var_dump($putanja);
$direktorij = dirname(getcwd());
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";
//require "$direktorij/dnevnik.class.php";

$autenticiran;

//var_dump($_GET);
$greska = "";
$poruka = "";

//$poruka = 'Nema greške!';
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


//$upit = "SELECT *FROM korisnik";
$upit = "SELECT *FROM `DZ4_korisnik` WHERE "
    . "`korisnicko_ime`='{$korime}' AND "
    . "`lozinka`='{$lozinka}'";

$rezultat = $veza->selectDB($upit);

$autenticiran = false;
while ($red = mysqli_fetch_array($rezultat)) {
    //var_dump($red);
    if ($red) {
        $autenticiran = true;
        $tip = $red["id_uloga"]; // tip/uloga korisnika
        $email = $red["email"];
    }
}

if ($autenticiran) {
    $poruka = 'Uspješna prijava!';
    // slanje maila (na poslužitelju); lokalno treba podesiti SMTP!
    /*
                  $mail_to = 'makaniski@foi.unizg.hr';
                  $mail_from = "From: noreplay@barka.foi.hr";
                  $mail_subject = '[WebDiP] Slanje maila';
                  $mail_body = 'Prijava u sustav!';

                  if (mail($mail_to, $mail_subject, $mail_body, $mail_from)) {
                  echo("Poslana poruka za: '$mail_to'!");
                  } else {
                  echo("Problem kod poruke za: '$mail_to'!");
                  }
                 */

    // kreiranje kolačića
    setcookie("autenticiran", $korime, false, '/', false);

    // kreiranje sesije
    Sesija::kreirajKorisnika($korime, $tip);
    header("Location: ../galerija.php");
} else {
    $poruka = 'Neuspješna prijava, pokušajte ponovo!';
}

$veza->zatvoriDB();


    // preporuka za izračun sažetka lozinke: korištenje sha1 i sha256 kriptiranja
    /*
      // zapis u bazi
      $salt = sha1(time());
      $kriptirano = hash("sha256",$salt."--".$lozinka);
      //citanje iz baze
      if(hash("sha256",$red['salt']."--".$lozinka) == $red['lozinka']);

     */
