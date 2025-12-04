document.body.onload = init();

function init() {
    feladat4get();
    feladat5get();
}

function feladat2() {
    fetch("index.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "2",
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            document.getElementById("feladat2text").innerHTML = "legelso tanc: " + valasz[0][0] + " legutolso tanc: " + valasz[0][1];
        });
}

function feladat3() {
    let tanc = document.getElementById("feladat3select").value

    fetch("index.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "3",
            tanc: tanc,
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            //console.log(valasz);
            document.getElementById("feladat3text").innerHTML = tanc + "-t " + valasz + "-an tancoltak"
        });
}

function feladat4get() {
    fetch("index.php")
        .then(x => x.json())
        .then(y => {
            //console.log(y)
            y.fiuk.forEach(element => {
                //console.log(element)
                fiu = element;
                //lany = element[1];
                //document.getElementById("feladat4selectlany").innerHTML += "<option>"+lany+"</option>"
                document.getElementById("feladat4select").innerHTML += "<option>" + fiu + "</option>"
            });

            y.lanyok.forEach(element => {
                //console.log(element)
                lany = element;
                //lany = element[1];
                //document.getElementById("feladat4selectlany").innerHTML += "<option>"+lany+"</option>"
                document.getElementById("feladat4select").innerHTML += "<option>" + lany + "</option>"
            });
        })
}

function feladat4() {
    let ember = document.getElementById("feladat4select").value

    fetch("index.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "4",
            ember: ember,
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            //console.log(valasz);
            document.getElementById("feladat4text").innerHTML = ember + " ezeket a táncokat táncolta: "

            valasz.forEach(x => {
                document.getElementById("feladat4text").innerHTML += x + ", "
            })
        });
}

function feladat5get() {
    fetch("index.php")
        .then(x => x.json())
        .then(y => {
            //console.log(y)
            y.fiuk.forEach(element => {
                //console.log(element)
                fiu = element;
                //lany = element[1];
                //document.getElementById("feladat4selectlany").innerHTML += "<option>"+lany+"</option>"
                document.getElementById("feladat5select").innerHTML += "<option>" + fiu + "</option>"
            });

            y.lanyok.forEach(element => {
                //console.log(element)
                lany = element;
                //lany = element[1];
                //document.getElementById("feladat4selectlany").innerHTML += "<option>"+lany+"</option>"
                document.getElementById("feladat5select").innerHTML += "<option>" + lany + "</option>"
            });
        })
}

function feladat5() {
    let ember = document.getElementById("feladat5select").value
    let tanc = document.getElementById("feladat5selecttanc").value

    fetch("index.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "5",
            ember: ember,
            tanc: tanc,
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            //console.log(valasz);

            if (valasz.length == 0) {
                document.getElementById("feladat5text").innerHTML = ember + " nem táncolt " + tanc + "-t";
            } else {
                document.getElementById("feladat5text").innerHTML = "A " + tanc + " bemutatóján " + ember + " párja " + valasz + " volt.";
            }


        });
}

function feladat6() {


    fetch("index.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "6",
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            //console.log(valasz);
            document.getElementById("feladat6text").innerHTML = "legtöbször szerepelt fiu/fiuk: ";
            valasz.fiuk.forEach(x => {
                document.getElementById("feladat6text").innerHTML += x + ", ";
            })

            document.getElementById("feladat6text").innerHTML += "és " + valasz.lanyokszam + " produkciban vettek reszt. <br>";

            document.getElementById("feladat6text").innerHTML += "legtöbször szerepelt lany/lanyok: ";
            valasz.lanyok.forEach(x => {
                document.getElementById("feladat6text").innerHTML += x + ", ";
            })

            document.getElementById("feladat6text").innerHTML += "és " + valasz.lanyokszam + " produkciban vettek reszt. <br>";
        });
}

function feladat7() {

    fetch("index.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "7",
        }),
    })
        .then(x => x.json())
        .then(valasz => {
            //console.log(valasz);

            document.getElementById("feladat7text").innerHTML = "Legtöbbször előadott tánc: " + valasz[0].tanc;

            const table = document.getElementById("table");
            table.classList.remove("d-none");


            table.innerHTML = `
                <tr>
                    <th>FIÚK</th>
                    <th>LÁNYOK</th>
                </tr>
            `;


            for (let i = 0; i < valasz.length - 1; i++) {
                table.innerHTML += `
                    <tr>
                        <td class="border-2">${valasz[i].fiu}</td>
                        <td class="border-2">${valasz[i].lany}</td>
                    </tr>
                `;
            }
        });
}
