<?php
$putanja = dirname($_SERVER['REQUEST_URI'], 2);
$direktorij = dirname(getcwd());
require "$direktorij/baza.class.php";
require "$direktorij/sesija.class.php";

Sesija::kreirajSesiju();

if (empty($_SERVER['HTTP_REFERER']) && isset($_SESSION['uloga']) && $_SESSION['uloga'] < 2) {
    header("Location: ../galerija.php");
}
if (empty($_SERVER['HTTP_REFERER']) && !isset($_SESSION['uloga'])) {
    header("Location: ./prijava.php");
}

if (!empty($_SESSION['id'])) {
    $mod = 'Način za ažuriranje';
} else {
    $mod = 'Način za dodavanje';
}

$datum = '';
$vrijeme = '';
$timovi = array_fill(0, 7, '');
$pozicije1 = array_fill(0, 3, '');
$pozicije2 = array_fill(0, 3, '');
$primarna_pozicija = '';
$sekundarna_pozicija = '';
$ime = '';
$prezime = '';
$golovi = '';
$dribling = '';
$asistencije = '';
$ocjena = '';
$poruka = '';
$greska = '';

if (isset($_POST['id'])) {
    if (isset($_SESSION['uloga']) && $_SESSION['uloga'] < 3) {
        $poruka = 'Ažuriranje može raditi samo administrator!';
    } else {
        $veza = new Baza();
        $veza->spojiDB();

        $id = $_POST['id'];
        $_SESSION['id'] = $id;
        $mod = 'Način za ažuriranje';

        $upit = "SELECT *FROM `DZ4_obrazac` WHERE "
            . "`id_obrazac`='{$id}'";

        $rezultat = $veza->selectDB($upit);

        while ($red = mysqli_fetch_array($rezultat)) {
            $datum = $red['datum'];
            $vrijeme = $red['vrijeme'];
            $tim = $red['tim'];
            setTeam();
            $primarna_pozicija = $red['primarna_pozicija'];
            $sekundarna_pozicija = $red['sekundarna_pozicija'];
            setPosition();
            $ime = $red['ime'];
            $prezime = $red['prezime'];
            $golovi = $red['golovi'];
            $dribling = $red['dribling'];
            $asistencije = $red['asistencije'];
            $ocjena = $red['ocjena'];
        }

        $veza->zatvoriDB();
    }
}

if (isset($_POST['submit'])) {
    $greska = '';
    if (!isset($_POST['first_position'])) {
        $greska .= "Nije popunjeno: first position <br>";
    }
    if (!isset($_POST['second_position'])) {
        $greska .= "Nije popunjeno: second position <br>";
    }
    foreach ($_POST as $k => $v) {
        if (empty($v) && $v !== '0') {
            $greska .= "Nije popunjeno: " . $k . "<br>";
        } elseif ($k === "time") {
            $uzorak1 = '/^(1[0-2]|0?[1-9]):([1-5][0-9]|0?[1-9]):([1-5][0-9]|0?[1-9])\s(AM|PM)$/';
            $uzorak2 = '/^(0?[0-9]|1\d|2[0-3]):([1-5][0-9]|0?[1-9]):([1-5][0-9]|0?[1-9])$/';
            $provjera1 = preg_match($uzorak1, $v);
            $provjera2 = preg_match($uzorak2, $v);
            if (!$provjera1 && !$provjera2) {
                $greska .= "Format za vrijeme je: 1. \"h:i:s AM/PM\" \"h\" ima vrijednosti 1-12, \"i\" i „s” ima "
                    . "vrijednosti 1-59. Na kraju je vrijednost AM ili PM;<br>"
                    . "2. \"h:i:s\" gdje \"h\" ima vrijednosti 0-23, \"i\" i \"s\" ima vrijednosti 1-59.<br>";
            }
        } elseif ($k === "date") {
            $provjera = validateDates($v);
            if (!$provjera) {
                $greska .= "Format je \"dd.mm.gggg.\" Gdje su \"d\", \"m\" i \"g\" brojke od 0-9 uz iznimke da prva \"d\" "
                    . "brojka može biti od 0-3, a prva \"m\" brojka 0 ili 1.<br>";
            }
        }
    }
    if (!empty($greska)) {
        $_SESSION['id'] = '';
    }
    if (empty($greska)) {
        $veza = new Baza();
        $veza->spojiDB();

        $datum = $_POST['date'];
        $vrijeme = $_POST['time'];
        $tim = $_POST['teams'];
        $primarna_pozicija = $_POST['first_position'];
        $sekundarna_pozicija = $_POST['second_position'];
        $ime = $_POST['name'];
        $prezime = $_POST['surname'];
        $golovi = $_POST['goals'];
        $dribling = $_POST['dribbles'];
        $asistencije = $_POST['assists'];
        $ocjena = $_POST['rating'];

        if (!empty($_SESSION['id'])) {
            $id = $_SESSION['id'];
            $upit = "UPDATE `DZ4_obrazac` SET `datum`='{$datum}',`vrijeme`='{$vrijeme}',`tim`='{$tim}',`primarna_pozicija`='{$primarna_pozicija}',"
                . "`sekundarna_pozicija`='{$sekundarna_pozicija}',`ime`='{$ime}',`prezime`='{$prezime}',`golovi`='{$golovi}',`dribling`='{$dribling}',"
                . "`asistencije`='{$asistencije}',`ocjena`='{$ocjena}' WHERE `id_obrazac`='{$id}'";

            $_SESSION['id'] = '';
        } else {
            $upit = "INSERT INTO `DZ4_obrazac`(`id_obrazac`, `datum`, `vrijeme`, `tim`, `primarna_pozicija`, "
                . "`sekundarna_pozicija`, `ime`, `prezime`, `golovi`, `dribling`, `asistencije`, `ocjena`) "
                . "VALUES (NULL,'{$datum}','{$vrijeme}','{$tim}','{$primarna_pozicija}',"
                . "'{$sekundarna_pozicija}','{$ime}','{$prezime}','{$golovi}','{$dribling}','{$asistencije}','{$ocjena}')";
        }

        $rezultat = $veza->updateDB($upit);

        $veza->zatvoriDB();

        header("Location: ../index.php");
    }
}

function setTeam()
{
    global $tim;
    global $timovi;
    switch ($tim) {
        case 'Barcelona':
            $timovi[0] = 'selected';
            break;
        case 'Real Madrid':
            $timovi[1]  = 'selected';
            break;
        case 'Atletico Madrid';
            $timovi[2] = 'selected';
            break;
        case 'Sevilla':
            $timovi[3] = 'selected';
            break;
        case 'Valencia':
            $timovi[4] = 'selected';
        case 'Real Betis':
            $timovi[5] = 'selected';
        case 'Granada':
            $timovi[6] = 'selected';
        default:
            break;
    }
}

function setPosition()
{
    global $primarna_pozicija;
    global $sekundarna_pozicija;
    global $pozicije1;
    global $pozicije2;

    switch ($primarna_pozicija) {
        case 'Napad':
            $pozicije1[0] = 'checked';
            break;
        case 'Veza':
            $pozicije1[1] = 'checked';
            break;
        case 'Obrana':
            $pozicije1[2] = 'checked';
        default:
            break;
    }
    switch ($sekundarna_pozicija) {
        case 'Napad':
            $pozicije2[0] = 'checked';
            break;
        case 'Veza':
            $pozicije2[1] = 'checked';
            break;
        case 'Obrana':
            $pozicije2[2] = 'checked';
        default:
            break;
    }
}

function validateDates($element)
{
    $valid = true;
    if (strlen($element) !== 11) {
        $valid = false;
        return $valid;
    } else {
        for ($i = 0; $i < strlen($element); $i++) {
            if ($i === 0) {
                $valid = true;
                if (!is_numeric($element[$i])) {
                    $valid = false;
                    return $valid;
                } else if ($element[$i] < 0 || $element[$i] > 3) {
                    $valid = false;
                    return $valid;
                }
            }
            if ($i === 1 || $i === 4 || ($i > 5 && $i < 10)) {
                if (!is_numeric($element[$i])) {
                    $valid = false;
                    return $valid;
                } else if ($element[$i] < 0 || $element[$i] > 9) {
                    $valid = false;
                    return $valid;
                }
            }
            if ($i === 3) {
                if (!is_numeric($element[$i])) {
                    $valid = false;
                    return $valid;
                } else if ($element[$i] < 0 || $element[$i] > 1) {
                    $valid = false;
                    return $valid;
                }
            }
            if ($i === 2 || $i === 5 || $i === 10) {
                if ($element[$i] != ".") {
                    $valid = false;
                    return $valid;
                }
            }
        }

        return $valid;
    }
}
?>

<!DOCTYPE html>

<html lang="hr">

<head>
    <title>Obrazac</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Obrazac" />
    <meta name="author" content="Toni Škobić" />
    <meta name="description" content="30.3.2021. Stranica obrazac web stranice, ključne riječi: obrazac, sport, novosti" />
    <link rel="stylesheet" href="../css/tskobic.css" />
    <link rel="alternate stylesheet" href="../css/tskobic_accesibility.css" />
</head>

<body>
    <header class="m-b-md">
        <a class="title link" href="#content">Obrazac</a>
        <?php
        include '../meni.php';
        ?>

        <section aria-label="social networks" class="social-icons">
            <img class="social-icon m-l-sm" src="../multimedija/images/facebook.png" alt="facebook" />
            <img class="social-icon m-l-sm" src="../multimedija/images/instagram.png" alt="instagram" />
            <a href="../rss.php" target="_blank"><img class="social-icon m-l-sm" src="../multimedija/images/rss.png" alt="rss" /></a>
        </section>
    </header>
    <main id="content" class="box" style="position: relative">
        <form novalidate class="form centered tutorial" method="post" action="">
            <div class="m-b-sm"><?php echo $mod; ?></div>
            <div class="font-color m-b-sm"><?php echo $poruka . "<br>" . $greska; ?></div>
            <div class="flex input-section">
                <label for="date">Datum:</label>
                <input type="text" name="date" id="date" class="validate validate-onchange" value="<?php echo $datum ?>" />
                <div class="tooltip">
                    <span class="help"> Pomoć </span>
                    <div class="help-message hidden">
                        Ovdje se unosi datum
                        <span class="next-button"> Dalje </span>
                    </div>
                </div>
            </div>

            <label for="time">Vrijeme:</label>
            <input type="text" name="time" id="time" class="validate" value="<?php echo $vrijeme ?>" />

            <div class="flex input-section">
                <label for="teams">Odaberite tim:</label>

                <select name="teams" id="teams" size="5">
                    <option value="Barcelona" <?php echo $timovi[0] ?>>Barcelona</option>
                    <option value="Real Madrid" <?php echo $timovi[1] ?>>Real Madrid</option>
                    <option value="Atletico Madrid" <?php echo $timovi[2] ?>>Atletico Madrid</option>
                    <option value="Sevilla" <?php echo $timovi[3] ?>>Sevilla</option>
                    <option value="Valencia" <?php echo $timovi[4] ?>>Valencia</option>
                    <option value="Real Betis" <?php echo $timovi[5] ?>>Real Betis</option>
                    <option value="Granada" <?php echo $timovi[6] ?>>Granada</option>
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
                <fieldset class="m-b-sm validate" id="first_position">
                    <legend>Primarna pozicija</legend>
                    <label for="primary_position1">Napad</label>
                    <input type="radio" name="first_position" id="primary_position1" class="position" value="Napad" <?php echo $pozicije1[0] ?> />
                    <label for="primary_position2">Veza</label>
                    <input type="radio" name="first_position" id="primary_position2" class="position" value="Veza" <?php echo $pozicije1[1] ?> />
                    <label for="primary_position3">Obrana</label>
                    <input type="radio" name="first_position" id="primary_position3" class="position" value="Obrana" <?php echo $pozicije1[2] ?> />
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
                <fieldset class="m-b-sm validate" id="second_position">
                    <legend>Sekundarna pozicija</legend>
                    <label for="secondary_position1">Napad</label>
                    <input type="radio" name="second_position" id="secondary_position1" class="second_position" value="Napad" <?php echo $pozicije2[0] ?> />
                    <label for="secondary_position2">Veza</label>
                    <input type="radio" name="second_position" id="secondary_position2" class="second_position" value="Veza" <?php echo $pozicije2[1] ?> />
                    <label for="secondary_position3">Obrana</label>
                    <input type="radio" name="second_position" id="secondary_position3" class="second_position" value="Obrana" <?php echo $pozicije2[2] ?> />
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
            <input type="text" name="name" id="name" value="<?php echo $ime ?>" />

            <label for="surname">Prezime:</label>
            <input type="text" name="surname" id="surname" value="<?php echo $prezime ?>" />

            <fieldset class="m-b-sm">
                <legend>Statistika</legend>
                <label for="goals">Golovi:</label>
                <input type="number" name="goals" id="goals" value="<?php echo $golovi ?>" />

                <label for="dribbles">Dribling:</label>
                <input type="number" name="dribbles" id="dribbles" value="<?php echo $dribling ?>" />

                <label for="assists">Asistencije:</label>
                <input type="number" name="assists" id="assists" value="<?php echo $asistencije ?>" />

            </fieldset>

            <label for="rating">Ocjena:</label>
            <input type="number" name="rating" id="rating" value="<?php echo $ocjena ?>" />

            <button type="reset" name="reset" class="button button--primary m-t-md">
                Resetiraj
            </button>
            <button type="submit" name="submit" class="button button--primary m-t-md" value="Unesi">
                Pošalji
            </button>
        </form>
        <?php
        include "../backup_buttons.php";
        ?>
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
            <a href="http://validator.w3.org/check?uri=http://barka.foi.hr/WebDiP/2020/zadaca_03/tskobic/obrazac.html" class="m-l-sm">
                <img src="../multimedija/images/HTML5.png" alt="html5" />
            </a>
            <a href="https://jigsaw.w3.org/css-validator/validator?uri=http://barka.foi.hr/WebDiP/2020/zadaca_04/tskobic/css/tskobic.css" class="m-l-sm">
                <img src="../multimedija/images/css3.png" alt="css3" />
            </a>
        </section>
    </footer>

    <!--<script src="../javascript/tskobic.js"></script>-->
</body>

</html>