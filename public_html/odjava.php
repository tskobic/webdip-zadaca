<?php
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

Sesija::kreirajSesiju();

if(empty($_SERVER['HTTP_REFERER']) && !isset($_SESSION['uloga'])) {
    header("Location: ./obrasci/prijava.php");
}

Sesija::obrisiSesiju();

setcookie("autenticiran", $_SESSION[Sesija::KORISNIK], time() - 3600, '/', false);

header("Location: ./obrasci/prijava.php");

?>