<?php
$putanja = dirname($_SERVER['REQUEST_URI']);
$direktorij = getcwd();
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

Sesija::kreirajSesiju();
$_SESSION['id'] = '';

if (empty($_SERVER['HTTP_REFERER']) && !isset($_SESSION['uloga'])) {
    header("Location: ./obrasci/prijava.php");
}

?>

<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Autor</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="O autoru" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="30.3.2021. Stranica O autoru web stranice, ključne riječi: autor, sport, novosti" />
    <link rel="stylesheet" href="./css/tskobic.css" />
    <style>
        html {
            font-size: 25px;
        }

        header {
            filter: grayscale(100%);
        }

        main {
            filter: grayscale(100%);
        }

        footer {
            filter: grayscale(100%);
        }

        .social-icons {
            flex-direction: column;
            margin-top: var(--gap-sm);
            margin-left: var(--gap-sm);
        }

        img.m-l-sm {
            margin-left: 0px;
            margin-bottom: var(--gap-sm);
        }

        .navigation {
            flex-direction: column;
            height: auto;
            flex-basis: 60%;
        }

        .list--direction {
            display: initial;
        }

        .list--direction>li:not(:last-child) {
            margin-bottom: 1rem;
        }

        ul {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Autor</a>
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
        <section aria-label="about author" class="box centered">
            <ul class="list--unstyled">
                <li>Ime: Toni</li>
                <li>Prezime: Škobić</li>
                <li>
                    <address>
                        E-pošta:
                        <a href="mailto:tskobic@foi.hr">tskobic@foi.hr</a>
                    </address>
                </li>
            </ul>
            <figure>
                <picture>
                    <source srcset="./multimedija/images/profilna.jpeg" />
                    <img src="./multimedija/images/profilna.jpeg" alt="Toni Škobić" />
                </picture>
                <figcaption>Toni Škobić</figcaption>
            </figure>
            <blockquote cite="https://www.fearlessmotivation.com/2017/03/11/15-powerful-lionel-messi-quotes/">
                <p>
                    "Morate se boriti da biste postigli svoj san. Za to se
                    morate žrtvovati i puno raditi."
                </p>
            </blockquote>
        </section>
        <iframe class="centered video" src="https://www.youtube.com/embed/PSanJ5swYBM?autoplay=1" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </main>
    <footer class="box-fluid footer m-t-md">
        <div>
            <a href="./autor.html">Toni Škobić</a>
            <p>&copy; 2021 T. Škobić</p>
        </div>
        <section aria-label="validation references">
            <a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/tskobic/autor.html" class="m-l-sm">
                <img src="./multimedija/images/HTML5.png" alt="html5" />
            </a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_04/tskobic/css/tskobic.css" class="m-l-sm">
                <img src="./multimedija/images/css3.png" alt="css3" />
            </a>
        </section>
    </footer>
</body>

</html>