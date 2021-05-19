<!DOCTYPE html>

<html lang="hr">
    <head>
        <title>Obrazac</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="title" content="Obrazac" />
        <meta name="author" content="Toni Škobić" />
        <meta
            name="description"
            content="30.3.2021. Stranica obrazac web stranice, ključne riječi: obrazac, sport, novosti"
        />
        <link rel="stylesheet" href="../css/tskobic.css" />
        <link
            rel="alternate stylesheet"
            href="../css/tskobic_accesibility.css"
        />
    </head>

    <body>
        <header class="m-b-md">
            <a class="title link" href="#content">Obrazac</a>
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
        <main id="content" class="box" style="position: relative">
            <form
                novalidate
                class="form centered tutorial"
                method="post"
                action="http://barka.foi.hr/WebDiP/2020/materijali/zadace/ispis_forme.php"
            >
                <div class="flex input-section">
                    <label for="date">Datum:</label>
                    <input
                        type="text"
                        name="date"
                        id="date"
                        class="validate validate-onchange"
                    />
                    <div class="tooltip">
                        <span class="help"> Pomoć </span>
                        <div class="help-message hidden">
                            Ovdje se unosi datum
                            <span class="next-button"> Dalje </span>
                        </div>
                    </div>
                </div>

                <label for="time">Vrijeme:</label>
                <input type="text" name="time" id="time" class="validate" />

                <div class="flex input-section">
                    <label for="teams">Odaberite tim:</label>

                    <select name="teams" id="teams" size="5">
                        <option value="barcelona" selected>Barcelona</option>
                        <option value="realmadrid">Real Madrid</option>
                        <option value="atleticomadrid">Atletico Madrid</option>
                        <option value="sevilla">Sevilla</option>
                        <option value="valencia">Valencia</option>
                        <option value="realbetis">Real Betis</option>
                        <option value="granada">Granada</option>
                    </select>
                    <div class="tooltip hidden">
                        <span class="help"> Pomoć </span>
                        <div class="help-message hidden">
                            Ovdje se odabire tim
                            <span class="next-button"> Dalje </span>
                        </div>
                    </div>
                </div>

                

                <div class="flex input-section">
                    <fieldset class="m-b-sm validate" id="first_team">
                        <legend>Primarna pozicija</legend>
                        <label for="primary_position1">Napad</label>
                        <input
                            type="radio"
                            name="first_team"
                            id="primary_position1"
                            class="position"
                            value="Napad"
                        />
                        <label for="primary_position2">Veza</label>
                        <input
                            type="radio"
                            name="first_team"
                            id="primary_position2"
                            class="position"
                            value="Veza"
                        />
                        <label for="primary_position3">Obrana</label>
                        <input
                            type="radio"
                            name="first_team"
                            id="primary_position3"
                            class="position"
                            value="Obrana"
                        />
                    </fieldset>
                    <div class="tooltip hidden">
                        <span class="help"> Pomoć </span>
                        <div class="help-message hidden">
                            Ovdje se odabire primarna pozicija
                            <span class="next-button"> Dalje </span>
                        </div>
                    </div>
                </div>

                <div class="flex input-section">
                    <fieldset class="m-b-sm validate" id="second_team">
                        <legend>Sekundarna pozicija</legend>
                        <label for="secondary_position1">Napad</label>
                        <input
                            type="radio"
                            name="second_team"
                            id="secondary_position1"
                            class="second_team"
                            value="Napad"
                        />
                        <label for="secondary_position2">Veza</label>
                        <input
                            type="radio"
                            name="second_team"
                            id="secondary_position2"
                            class="second_team"
                            value="Veza"
                        />
                        <label for="secondary_position3">Obrana</label>
                        <input
                            type="radio"
                            name="second_team"
                            id="secondary_position3"
                            class="second_team"
                            value="Obrana"
                        />
                    </fieldset>
                    <div class="tooltip hidden">
                        <span class="help"> Pomoć </span>
                        <div class="help-message hidden">
                            Ovdje se odabire sekundarna pozicija
                            <span class="next-button"> Zatvori </span>
                        </div>
                    </div>
                </div>

                <label for="name">Ime:</label>
                <input type="text" name="name" id="name" />

                <label for="surname">Prezime:</label>
                <input type="text" name="surname" id="surname" />

                <fieldset class="m-b-sm">
                    <legend>Statistika</legend>
                    <label for="goals">Golovi:</label>
                    <input type="number" name="goals" id="goals" />

                    <label for="dribbles">Dribling:</label>
                    <input type="number" name="dribbles" id="dribbles" />

                    <label for="assists">Asistencije:</label>
                    <input type="number" name="assists" id="assists" />

                </fieldset>

                <label for="rating">Ocjena:</label>
                <input type="number" name="rating" id="rating" />

                <button
                    type="reset"
                    name="reset"
                    class="button button--primary m-t-md"
                >
                    Resetiraj
                </button>
                <button
                    type="submit"
                    name="submit"
                    class="button button--primary m-t-md"
                >
                    Pošalji
                </button>
            </form>
        </main>
        <div class="blur hidden"></div>
        <div class="popup hidden">
            Neispravan unos.<br />
            Trebate li pomoć?
            <div class="popup-buttons">
                <span class="yes">Da</span>
                <span class="no">Ne</span>
            </div>
        </div>
        <div class="accesibility">Pristupačnost</div>
        <footer class="box-fluid footer m-t-md">
            <div>
                <a href="../autor.html">Toni Škobić</a>
                <p>&copy; 2021 T. Škobić</p>
            </div>
            <section aria-label="validation references">
                <a
                    href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/tskobic/obrazac.html"
                    class="m-l-sm"
                >
                    <img src="../multimedija/images/HTML5.png" alt="html5" />
                </a>
                <a
                    href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_04/tskobic/css/tskobic.css"
                    class="m-l-sm"
                >
                    <img src="../multimedija/images/css3.png" alt="css3" />
                </a>
            </section>
        </footer>

        <!--<script src="../javascript/tskobic.js"></script>-->
    </body>
</html>
