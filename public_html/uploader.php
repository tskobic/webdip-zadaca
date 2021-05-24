<?php
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

Sesija::kreirajSesiju();

$userfile = $_FILES['userfile']['tmp_name'];
$userfile_name = $_FILES['userfile']['name'];
$userfile_size = $_FILES['userfile']['size'];
$userfile_type = $_FILES['userfile']['type'];
$userfile_error = $_FILES['userfile']['error'];

if ($userfile_type != 'application/octet-stream') {
    header("Location: ./obrasci/obrazac.php");
    exit;
}
$upfile = 'datoteke/' . $userfile_name;

$_SESSION['file'] = $upfile;

if (is_uploaded_file($userfile)) {
    if (!move_uploaded_file($userfile, $upfile)) {
        header("Location: ./obrasci/obrazac.php");
        exit;
    }
} else {
    header("Location: ./obrasci/obrazac.php");
    exit;
}

header("Location: ./obrasci/obrazac.php");
?>