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
    <title>Galerija</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Galerija" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="30.3.2021. Stranica galerija, ključne riječi: galerija, sport, novosti" />
    <link rel="stylesheet" href="./css/tskobic.css" />

    <style>
        .zoom {
            transition: all 0.2s ease-out;
            border: 5px solid rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 15px;
            opacity: 0.8;
        }

        .zoom:hover {
            transform: scale(1.1);
            border: 5px solid rgba(0, 0, 0, 1);
            opacity: 1;
        }

        .border-width {
            border-width: 10px;
        }

        .border-width:hover {
            border-width: 10px;
        }
    </style>
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Galerija</a>
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
        <button name="load" class="button button--primary m-t-md m-b-md centered load">
            Učitaj slike
        </button>

        <section class="gallery" aria-label="gallery">
            <div class="gallery__image default hidden">
                <figure class="zoom">
                    <picture>
                        <source srcset="./multimedija/images/default.jpg" />
                        <img src="./multimedija/images/default.jpg" alt="Default" />
                    </picture>
                    <figcaption>Ronaldinho</figcaption>
                </figure>
            </div>
            <div class="gallery__image">
                <figure class="zoom">
                    <picture>
                        <source srcset="./multimedija/images/barcelona.png" />
                        <img src="./multimedija/images/barcelona.png" alt="Barcelona" />
                    </picture>
                    <figcaption>Barcelona</figcaption>
                </figure>
            </div>
            <div class="gallery__image">
                <figure class="zoom">
                    <picture>
                        <source srcset="./multimedija/images/benzema.jpg" />
                        <img src="./multimedija/images/benzema.jpg" alt="Benzema" />
                    </picture>
                    <figcaption>Benzema</figcaption>
                </figure>
            </div>
            <div class="gallery__image">
                <figure class="zoom">
                    <picture>
                        <source srcset="./multimedija/images/granadaplayers.jpg" />
                        <img src="./multimedija/images/granadaplayers.jpg" alt="Igrači Granade" />
                    </picture>
                    <figcaption>Igrači Granade</figcaption>
                </figure>
            </div>
            <div class="gallery__image">
                <figure class="zoom">
                    <picture>
                        <source srcset="./multimedija/images/griezmann.jpg" />
                        <img src="./multimedija/images/griezmann.jpg" alt="Antoine Griezmann" />
                    </picture>
                    <figcaption>Antoine Griezmann</figcaption>
                </figure>
            </div>
            <div class="gallery__image">
                <figure class="zoom">
                    <picture>
                        <source srcset="./multimedija/images/joaofelix.jpg" />
                        <img src="./multimedija/images/joaofelix.jpg" alt="Joao Felix" />
                    </picture>
                    <figcaption>Joao Felix</figcaption>
                </figure>
            </div>
            <div class="gallery__image">
                <figure class="zoom">
                    <picture>
                        <source srcset="./multimedija/images/koke.jpg" />
                        <img src="./multimedija/images/koke.jpg" alt="Koke" />
                    </picture>
                    <figcaption>Koke</figcaption>
                </figure>
            </div>
            <div class="gallery__image">
                <figure class="zoom">
                    <picture>
                        <source srcset="./multimedija/images/laliga.png" />
                        <img src="./multimedija/images/laliga.png" alt="LaLiga" />
                    </picture>
                    <figcaption>LaLiga logo</figcaption>
                </figure>
            </div>
            <div class="gallery__image">
                <figure class="zoom">
                    <picture>
                        <source srcset="./multimedija/images/laligaball.jpg" />
                        <img src="./multimedija/images/laligaball.jpg" alt="LaLiga lopta" />
                    </picture>
                    <figcaption>LaLiga lopta</figcaption>
                </figure>
            </div>
            <div class="gallery__image">
                <figure class="zoom">
                    <picture>
                        <source srcset="./multimedija/images/messi.jpeg" />
                        <img src="./multimedija/images/messi.jpeg" alt="Lionel Messi" />
                    </picture>
                    <figcaption>Lionel Messi</figcaption>
                </figure>
            </div>
            <div class="gallery__image">
                <figure class="zoom">
                    <picture>
                        <source srcset="./multimedija/images/modrić.jpeg" />
                        <img src="./multimedija/images/modrić.jpeg" alt="Luka Modrić" />
                    </picture>
                    <figcaption>Luka Modrić</figcaption>
                </figure>
            </div>
            <div class="gallery__image">
                <figure class="zoom">
                    <picture>
                        <source srcset="./multimedija/images/ramos.jpg" />
                        <img src="./multimedija/images/ramos.jpg" alt="Sergio Ramos" />
                    </picture>
                    <figcaption>Sergio Ramos</figcaption>
                </figure>
            </div>
            <div class="gallery__image">
                <figure class="zoom">
                    <picture>
                        <source srcset="./multimedija/images/suarez.jpg" />
                        <img src="./multimedija/images/suarez.jpg" alt="Luis Suarez" />
                    </picture>
                    <figcaption>Luis Suarez</figcaption>
                </figure>
            </div>

        </section>
    </main>
    <div class="blur hidden"></div>
    <div class="popup hidden">
        Greška kod učitavanja!
        <div class="popup-buttons">
            <span class="okay">U redu</span>
        </div>
    </div>
    <footer class="box-fluid footer m-t-md">
        <div>
            <a href="./autor.html">Toni Škobić</a>
            <p>&copy; 2021 T. Škobić</p>
        </div>
        <section aria-label="validation references">
            <a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/tskobic/galerija.html" class="m-l-sm">
                <img src="./multimedija/images/HTML5.png" alt="html5" />
            </a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_04/tskobic/css/tskobic.css" class="m-l-sm">
                <img src="./multimedija/images/css3.png" alt="css3" />
            </a>
        </section>
    </footer>

    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="./javascript/tskobic_jquery.js"></script>-->
</body>

</html>