<?php
header("Content-Type: application/json");

$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

$veza = new Baza();
$veza->spojiDB();

$id = $_GET['submit'];

$upit = "SELECT *FROM `DZ4_obrazac` WHERE "
        . "`id_obrazac`='{$id}'";

$rezultat = $veza->selectDB($upit);

$red = mysqli_fetch_assoc($rezultat);

$json = json_encode($red);
if ($json === false) {
    $json = json_encode(["jsonError" => json_last_error_msg()]);
    if ($json === false) {
        $json = '{"jsonError":"unknown"}';
    }

    http_response_code(500);
}
echo $json;
?>