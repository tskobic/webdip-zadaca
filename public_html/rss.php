<?php
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

Sesija::kreirajSesiju();

$veza = new Baza();
$veza->spojiDB();

header('Content-type: application/xml'); 

echo "<rss version='2.0' xmlns:atom='http://barka.foi.hr/WebDiP/2020/zadaca_04/tskobic/'>\n";
echo "<channel>\n";

echo "<title>RSS kanal</title>\n";
echo "<description>RSS opis</description>\n";
echo "<link>http://barka.foi.hr/WebDiP/2020/zadaca_04/tskobic/</link>\n";

 
$upit = "SELECT *FROM `DZ4_obrazac` ORDER BY `id_obrazac` DESC LIMIT 10";
$rezultat = $veza->selectDB($upit);


while($red = mysqli_fetch_array($rezultat)) {
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
    
     echo "<item>n";
         echo "<title>$ime $prezime</title>\n";
         echo "<description>$tim</description>\n";
         echo "<pubDate>$datum GMT</pubDate>\n";
         echo "<link>http://barka.foi.hr/WebDiP/2020/zadaca_04/tskobic/$golovi</link>\n";
         echo "<guid>http://barka.foi.hr/WebDiP/2020/zadaca_04/tskobic/$dribling</guid>\n";
         echo "<atom:link href='http://barka.foi.hr/WebDiP/2020/zadaca_04/tskobic/$ocjena' rel='self' type='application/rss+xml'/>\n";
     echo "</item>\n";

}

echo "</channel>\n";
echo "</rss>\n";

?>