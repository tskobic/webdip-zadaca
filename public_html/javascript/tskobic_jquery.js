$(document).ready(function () {
    naslov = $(document).find("title").text();
    switch (naslov) {
        case "Početna":
            alert(naslov);
            /*$("#tablica").dataTable({
                aaSorting: [
                    [0, "asc"],
                    [1, "asc"],
                    [2, "asc"],
                ],
                bPaginate: true,
                bLengthChange: true,
                bFilter: true,
                bSort: true,
                bInfo: true,
                bAutoWidth: true,
            });*/
            break;
        case "Prijava":
            alert(naslov);
            greske = true;

            var gradovi = new Array();

            $.getJSON("../json/cities.json", function (data) {
                $.each(data, function (key, val) {
                    console.log(val);
                    gradovi.push(val);
                });
            });

            $("#gradovi").autocomplete({
                source: gradovi,
            });

            $("#username").keyup(function (event) {
                $.ajax({
                    url:
                        "http://barka.foi.hr/WebDiP/2020/materijali/zadace/dz3/korisnik.php",
                    type: "GET",
                    data: { korisnik: $("#username").val() },
                    dataType: "xml",
                    success: function (xml) {
                        $(xml)
                            .find("korisnik")
                            .each(function () {
                                //console.log($(this).text());
                                //console.log(typeof($(this).text()));
                                if ($(this).text() === "1") {
                                    $("#username").attr(
                                        "style",
                                        "border-color:green"
                                    );
                                    greske = false;
                                } else {
                                    $("#username").attr(
                                        "style",
                                        "border-color:red"
                                    );
                                    greske = true;
                                }
                            });
                    },
                    error: function (xhr, status, error) {
                        alert("Pogreška: " + error.responseText);
                    },
                });
            });

            $("#prijava").submit(function () {
                if (greske) {
                    event.preventDefault();
                }
            });

            break;
        default:
            alert("Stranica ne postoji!");
            break;
    }

    $("#password").keyup(function (event) {
        /* *
         8-20 znakova,
         najmanje 1 alfanumerički znak,
         najmanje 1 broj ili specijalni znak i
         ne smiju se više od 3 znaka ponavljati
         */
        var lozinka = $("#password").val();
        var re = new RegExp(
            /^(?!.*(.)\1{3})((?=.*[\d])(?=.*[A-Za-z])|(?=.*[^\w\d\s])(?=.*[A-Za-z])).{8,20}$/
        );
        var ok = re.test(lozinka);
        if (!ok) {
            //console.log("Tekst se ne poklapa s predloškom!");
            $("#password").attr("style", "border-color:red");
            greske = true;
        } else {
            //console.log("OK!");
            $("#password").attr("style", "border-color:green");
            greske = false;
        }
    });
});
