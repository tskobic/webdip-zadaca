<!DOCTYPE html>

<html lang="hr">
    <head>
        <title>Registracija</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="title" content="Registracija" />
        <meta name="author" content="Toni Škobić" />
        <meta
            name="description"
            content="30.3.2021. Stranica registracije, ključne riječi: registracija, sport, novosti"
        />
        <link rel="stylesheet" href="../css/tskobic.css" />
        <!--<link
            rel="stylesheet"
            href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"
        />-->
    </head>

    <body>
        <header class="m-b-md">
            <a class="title link" href="#content">Registracija</a>
            <nav class="box-fluid navigation">
                <ul class="list--unstyled list--direction">
                    <li>
                        <a href="../index.php">Početna</a>
                    </li>
                    <li>
                        <a href="../autor.php">O autoru</a>
                    </li>
                    <li>
                        <a href="../galerija.php">Galerija</a>
                    </li>
                    <li>
                        <a href="./prijava.php">Prijava</a>
                    </li>
                    <li>
                        <a href="./registracija.php">Registracija</a>
                    </li>
                    <li>
                        <a href="./obrazac.php">Obrazac</a>
                    </li>
                    <li>
                        <a href="../era.php">ERA</a>
                    </li>
                    <li>
                        <a href="../navigacijski.php">Navigacijski dijagram</a>
                    </li>
                </ul>
            </nav>

            <section aria-label="social networks" class="social-icons">
                <img
                    class="social-icon m-l-sm"
                    src="../multimedija/images/facebook.png"
                    alt="facebook"
                />
                <img
                    class="social-icon m-l-sm"
                    src="../multimedija/images/instagram.png"
                    alt="instagram"
                />
                <img
                    class="social-icon m-l-sm"
                    src="../multimedija/images/rss.png"
                    alt="rss"
                />
            </section>
        </header>
        <main id="content" class="box">
            <form
                novalidate
                class="form centered"
                method="post"
                action="http://barka.foi.hr/WebDiP/2020/materijali/zadace/ispis_forme.php"
            >
                <label for="name">Ime:</label>
                <input type="text" name="name" id="name" class="name" />

                <label for="surname">Prezime:</label>
                <input type="text" name="surname" id="surname" class="surname" />

                <label for="username">Korisničko ime:</label>
                <input type="text" name="username" id="username" class="username" />

                <label for="e-mail">Elektronička pošta:</label>
                <input type="email" name="e-mail" id="e-mail" />

                <label for="password">Lozinka:</label>
                <input type="password" name="password" id="password" class="password" />

                <label for="confirm_password">Potvrda lozinke:</label>
                <input
                    type="password"
                    name="confirm password"
                    id="confirm_password"
                    class="confirm_password"
                />

                <label for="datetime">Datum i vrijeme:</label>
                <input type="text" name="datetime" id="datetime" class="datetime" />

                <button
                    type="submit"
                    name="submit"
                    class="button button--primary m-t-md"
                >
                    Registriraj se
                </button>
            </form>
        </main>
        <footer class="box-fluid footer m-t-md">
            <div>
                <a href="../autor.html">Toni Škobić</a>
                <p>&copy; 2021 T. Škobić</p>
            </div>
            <section aria-label="validation references">
                <a
                    href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/tskobic/obrasci/registracija.html"
                    class="m-l-sm"
                >
                    <img src="../multimedija/images/HTML5.png" alt="html5" />
                </a>
                <a
                    href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/tskobic/css/tskobic.css"
                    class="m-l-sm"
                >
                    <img src="../multimedija/images/css3.png" alt="css3" />
                </a>
            </section>
        </footer>

        <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script
            src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"
        ></script>
        <script src="../javascript/tskobic_jquery.js"></script>-->
    </body>
</html>
