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
    <title>Navigacijski dijagram</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Navigacijski dijagram" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="10.4.2021. Navigacijski dijagram stranica web stranice, ključne riječi: navigacijski, sport, novosti" />

    <link rel="stylesheet" href="./css/tskobic.css" />
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Navigacijski dijagram</a>
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
        <section class="gallery" aria-label="gallery">
            <a href="./multimedija/images/tskobic-navigacijski1.png">
                <figure class="figure-width">
                    <picture class="diagrams">
                        <source srcset="
                                    ./multimedija/images/tskobic-navigacijski1.png
                                " />
                        <img src="./multimedija/images/tskobic-navigacijski1.png" alt="Navigacijski dijagram za neregistriranog korisnika" width="200" height="200" />
                    </picture>
                    <figcaption>
                        Navigacijski dijagram za neregistriranog korisnika
                    </figcaption>
                </figure>
            </a>
            <a href="./multimedija/images/tskobic-navigacijski2.png">
                <figure class="figure-width">
                    <picture class="diagrams">
                        <source srcset="
                                    ./multimedija/images/tskobic-navigacijski2.png
                                " />
                        <img src="./multimedija/images/tskobic-navigacijski2.png" alt="Navigacijski dijagram za registriranog korisnika" width="200" height="200" />
                    </picture>
                    <figcaption>
                        Navigacijski dijagram za registriranog korisnika
                    </figcaption>
                </figure>
            </a>
            <a href="./multimedija/images/tskobic-navigacijski3.png">
                <figure class="figure-width">
                    <picture class="diagrams">
                        <source srcset="
                                    ./multimedija/images/tskobic-navigacijski3.png
                                " />
                        <img src="./multimedija/images/tskobic-navigacijski3.png" alt="Navigacijski dijagram za moderatora" width="200" height="200" />
                    </picture>
                    <figcaption>
                        Navigacijski dijagram za moderatora
                    </figcaption>
                </figure>
            </a>
            <a href="./multimedija/images/tskobic-navigacijski4.png">
                <figure class="figure-width">
                    <picture class="diagrams">
                        <source srcset="
                                    ./multimedija/images/tskobic-navigacijski4.png
                                " />
                        <img src="./multimedija/images/tskobic-navigacijski4.png" alt="Navigacijski dijagram za administratora" width="200" height="200" />
                    </picture>
                    <figcaption>
                        Navigacijski dijagram za administratora
                    </figcaption>
                </figure>
            </a>
        </section>
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