<?php

if(isset($_SESSION['uloga']) && $_SESSION['uloga'] >= 3) {

    $ispis = '';

    if(isset($_SESSION['file'])) {
        $ispis = $_SESSION['file'];
    }

    echo "<form novalidate class=\"form centered m-t-md\" method=\"get\" action=\"../backup.php\">"
        ."<label for=\"e-mail\">Elektronička pošta:</label><input type=\"email\" name=\"email\" id=\"email\"/>"
        ."<button type=\"submit\" name=\"napravi\" class=\"button button--primary\" value=\"Napravi\">Napravi sigurnosnu kopiju</button>"
        ."<button type=\"submit\" name=\"vrati\" class=\"button button--primary m-t-sm m-b-sm\" value=\"Vrati\">Vrati iz sigurnosne kopije</button>{$ispis}</form>"
        ."<form enctype=\"multipart/form-data\" class=\"form centered m-t-md\" action= \"../uploader.php\" method=\"post\"><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"60000\"/>"
        ."Postavi datoteku: <input name=\"userfile\" type=\"file\"/>"
        ."<input type=\"submit\" value=\"Pošalji\" /></form>";
}

?>