<?php
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

Sesija::kreirajSesiju();
$_SESSION['id'] = '';

if (empty($_SERVER['HTTP_REFERER']) && isset($_SESSION['uloga']) && $_SESSION['uloga'] < 3) {
    header("Location: ./galerija.php");
}
if (empty($_SERVER['HTTP_REFERER']) && !isset($_SESSION['uloga'])) {
    header("Location: ./obrasci/prijava.php");
}

?>

<!DOCTYPE html>

<html lang="hr">

<head>
    <title>ERA</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="ERA" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="10.4.2021. ERA stranica web stranice, ključne riječi: ERA, sport, novosti" />

    <link rel="stylesheet" href="./css/tskobic.css" />
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">ERA</a>
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
        <a href="./multimedija/images/tskobic-ERA.png">
            <figure>
                <picture class="diagrams">
                    <source srcset="./multimedija/images/tskobic-ERA.png" />
                    <img src="./multimedija/images/tskobic-ERA.png" alt="ERA" width="200" height="200" />
                </picture>
                <figcaption>ERA</figcaption>
            </figure>
        </a>
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
</body>

</html>