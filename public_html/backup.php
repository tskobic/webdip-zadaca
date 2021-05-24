<?php
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

Sesija::kreirajSesiju();

if (empty($_SERVER['HTTP_REFERER'])) {
    header("Location: ./obrasci/prijava.php");
}

if(isset($_GET['napravi'])) {
    //$command = "mysqldump --opt -u 'root' WebDiP2020x119 DZ4_uloga DZ4_obrazac DZ4_korisnik -r datoteke/backup.sql";
    $command = "mysqldump --opt -u 'WebDiP2020x119' -p'12345' WebDiP2020x119 DZ4_uloga DZ4_obrazac DZ4_korisnik -r datoteke/backup.sql";
    exec($command);

    $_SESSION['file'] = 'datoteke/backup.sql';

    $mail = $_GET['email'];
    $polje = explode("@", $mail);
    $username = $polje[0];
    
    $mail_to = $mail;
    $mail_from = "From: noreplay@barka.foi.hr";
    $mail_subject = "SK - {$username}";
    $mail_body = 'Sigurnosna kopija napravljena!';

    mail($mail_to, $mail_subject, $mail_body, $mail_from);
    
    header("Location: ./obrasci/obrazac.php");
}
if(isset($_GET['vrati'])) {
    if(!empty($_SESSION['file'])) {
        $file = $_SESSION['file'];
        //$command = "mysql -u 'root' WebDiP2020x119 < {$file}";
        $command = "mysql -u 'WebDiP2020x119' -p'12345' WebDiP2020x119 < {$file}";
        exec($command);
        unlink ($file); 
        
        $mail = $_GET['email'];
        $polje = explode("@", $mail);
        $username = $polje[0];
    
        $mail_to = $mail;
        $mail_from = "From: noreplay@barka.foi.hr";
        $mail_subject = "SK - {$username}";
        $mail_body = 'Podaci preuzeti iz sigurnosne kopije!';
    
        mail($mail_to, $mail_subject, $mail_body, $mail_from);
        
        $_SESSION['file'] = '';
    }
    header("Location: ./obrasci/obrazac.php");
}
?>