window.addEventListener("load", function (e) {
    let domElements = document.querySelectorAll(".load");
    domElements.forEach((domElement) => {
        domElement.addEventListener("click", () => {
            let xhttp = new XMLHttpRequest();
            let url = "podaci.php";
            let id = domElement.getAttribute("value");
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let data = JSON.parse(xhttp.responseText);
                    document.querySelector(".rowdata").innerHTML = "ID = " + data.id_obrazac + "; Datum = " + data.datum + "; Vrijeme = " 
                                                                    + data.vrijeme + "; Primarna pozicija = " + data.primarna_pozicija + "; Sekundarna pozicija = " 
                                                                    + data.sekundarna_pozicija + "; Ime = " + data.ime + "; Prezime = " + data.prezime + "; Golovi = " 
                                                                    + data.golovi + "; Dribling = " + data.dribling + "; Asistencije = " + data.asistencije + "; Ocjena = " 
                                                                    + data.ocjena;
                }
            };
            xhttp.open("GET", url+"?"+"submit="+id, true);
            xhttp.send();
        });
    });
});
