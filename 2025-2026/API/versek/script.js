function versek(db = 0) {
    if (db == 0) {
        fetch("versek")
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            });
    } else if (db > 0) {
        fetch("versek/" + db)
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            });
    }
}

function vers(id) {
    fetch("vers/" + id)
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
        });
}

function kolto(id = 0) {
    if (id == 0) {
        fetch("kolto")
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                bal(data);
            });
    } else if (id > 0) {
        fetch("kolto/" + id)
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
            });
    }
}

function init() {
    kolto();
    fejlec();
    fetch("versek/4")
        .then((response) => response.json())
        .then((data) => {
            jobb(data);
        });
}

function bal(adatok) {
    vissza = "";
    adatok.forEach((e) => {
        vissza += `<button class="btn btn-dark w-100 m-1" onclick="koltoClick(${e.id})">
            ${e.nev}
        </button>
        `;
    });
    document.getElementById("bal").innerHTML = vissza;
}

function jobb(adatok) {
    vissza = "";
    adatok.forEach((e) => {
        let elsoVersszak = "Nincs szöveg";
        if (e.versszakok != null) {
            elsoVersszak = e.versszakok.split(" \n ")[0];
            console.log(elsoVersszak);
            if (elsoVersszak.includes("/")) {
                elsoVersszak = elsoVersszak.trim().replaceAll("/", "\n\r");
            }
        }
        vissza += `<div class="p-2 m-2 bg-dark rounded-3">
            <h4>
                ${e.cim}
            </h4>
            <p style="white-space: pre-line;">${elsoVersszak}</p>
            <i>
                ${e.kolto_nev}
            </i>
        </div>`;
    });
    document.getElementById("jobb").innerHTML = vissza;
}

function fejlec() {
    fetch("versek")
        .then((response) => response.json())
        .then((data) => {
            vissza = "";
            data.forEach((e) => {
                let elsoVersszak = "Nincs szöveg";
                if (e.versszakok != null) {
                    elsoVersszak = e.versszakok.split(" \n ")[0];
                    if (elsoVersszak.includes("/")) {
                        elsoVersszak = elsoVersszak.replaceAll("/", "\n\r");
                    }
                }
                vissza += `<div class="p-2 m-2 bg-dark rounded-3">
            <p style="white-space: pre-line;">„${elsoVersszak}”</p>
            <i>
                ${e.kolto_nev}: 
                ${e.cim},
            </i>
            <span>
                ${e.megjelenes_eve}
            </span>
        </div>`;
            });
            document.getElementById("fejlec").innerHTML = vissza;
        });
}
function koltoClick(id) {
    fetch("kolto/" + id)
        .then((response) => response.json())
        .then((data) => {
            let e = data[0];

            let vissza = `
            <div class="p-2 m-2 bg-dark rounded-3">
                <h2>${e.nev}</h2>
                <p>${e.eletrajz}</p>
                <p>Született: ${e.szuletesi_datum}, ${e.szuletesi_hely}</p>
                <p>Elhunyt: ${e.halalozi_datum}, ${e.halalozi_hely}</p>
                <hr>
                <h5>Versei:</h5>
                <div id="vers-lista"></div>
            </div>`;

            document.getElementById("jobb").innerHTML = vissza;

            fetch("versek/100")
                .then((res) => res.json())
                .then((versek) => {
                    let versekHtml = "";
                    versek.forEach((v) => {
                        if (v.kolto_nev == e.nev) {
                            versekHtml += `
                                <div class="p-1">
                                    <span style="cursor:pointer; text-decoration:underline" onclick="mutatVers(${v.vers_id})">
                                        ${v.cim}
                                    </span>
                                    <div id="vers-szoveg-${v.vers_id}" style="display:none; padding:10px; font-style:italic; color:gray">
                                        </div>
                                </div>`;
                        }
                    });
                    document.getElementById("vers-lista").innerHTML = versekHtml;
                });
        });
}
function mutatVers(id) {
    let div = document.getElementById("vers-szoveg-" + id);

    if (div.style.display == "block") {
        div.style.display = "none";
    } else {
        fetch("vers/" + id)
            .then((response) => response.json())
            .then((data) => {
                let v = data[0];
                let nyers = v.versszakok ? String(v.versszakok) : "Nincs szöveg";
                div.innerHTML = nyers.split("\n").join("<br>");
                div.style.display = "block";
            });
    }
}

setInterval(fejlec, 30000);
