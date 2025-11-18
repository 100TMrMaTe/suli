class Konyv {
  constructor(ev, negyedEv, eredet, leiras, peldanyszam) {
    this.ev = Number(ev);
    this.negyedEv = Number(negyedEv);
    this.eredet = eredet;
    this.leiras = leiras;
    this.peldanyszam = Number(peldanyszam);
  }
}

let konyvek = [];
function init() {
  //1.feladat
  fetch("kiadas.txt")
    .then((response) => response.text())
    .then((data) => {
      let sorok = data.split("\n");
      sorok.pop();
      sorok.forEach((x) => {
        let vag = x.split(";");
        //console.log(vag)
        konyvek.push(new Konyv(vag[0], vag[1], vag[2], vag[3], vag[4]));
      });
    });
}

document
  .getElementById("szerzoBe")
  .addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
      let kiadasDB = 0;
      event.preventDefault();
      konyvek.forEach((x) => {
        if (x.leiras.includes(document.getElementById("szerzoBe").value)) {
          kiadasDB++;
        }
      });
      if (kiadasDB != 0) {
        document.getElementById(
          "2feladat"
        ).innerHTML = `${kiadasDB} könyvkiadás`;
      } else {
        document.getElementById("2feladat").innerHTML = "Nem adtak ki";
      }
    }
  });

function feladat3() {
  let max = 0;
  konyvek.forEach((x) => {
    if (x.peldanyszam > max) {
      max = x.peldanyszam;
    }
  });
  let legnagyobb = konyvek.filter((x) => x.peldanyszam == max);
  document.getElementById(
    "3feladat"
  ).innerHTML = `3.feladat:<br> Legnagyobb példányszám: ${max}, előfordult ${legnagyobb.length} alkalommal`;
}

function feladat4() {
  let kulfoldi = konyvek.filter(
    (x) => x.eredet == "kf" && x.peldanyszam >= 40000
  )[0];
  document.getElementById(
    "4feladat"
  ).innerHTML = `4.feladat:<br> ${kulfoldi.ev}/${kulfoldi.negyedEv}. ${kulfoldi.leiras}`;
}

function feladat5(fajlnev) {
  let evek = [];
  konyvek.forEach((x) => {
    if (!evek.includes(x.ev)) {
      evek.push(x.ev);
    }
  });

  let tablazat = [];
  evek.forEach((y) => {
    let magyarPeldaynszam = 0;
    let magyarKiadas = konyvek.filter((x) => x.ev == y && x.eredet == "ma");
    magyarKiadas.forEach((x) => (magyarPeldaynszam += x.peldanyszam));
    let kulfoldiPeldanyszam = 0;
    let kulfoldiKiadas = konyvek.filter((x) => x.ev == y && x.eredet == "kf");
    kulfoldiKiadas.forEach((x) => (kulfoldiPeldanyszam += x.peldanyszam));
    let sor = [
      y,
      magyarKiadas.length,
      magyarPeldaynszam,
      kulfoldiKiadas.length,
      kulfoldiPeldanyszam,
    ];
    tablazat.push(sor);
  });

  let tartalom = `
<table>
<tr><th>Év</th><th>Magyar kiadás</th><th>Magyar példányszám</th><th>Külföldi
kiadás</th><th>Külföldi példányszám</th></tr>`;
  tablazat.forEach((x) => {
    tartalom += `<tr><td>${x[0]}</td><td>${x[1]}</td><td>${x[2]}</td><td>${x[3]}</td><td>${x[4]}</td></tr>`;
  });
  tartalom += `</table>`;
  document.getElementById("5feladat").innerHTML = `5.feladat:<br>
${tartalom}`;
  const blob = new Blob([tartalom], { type: "text/html" });
  const link = document.createElement("a");
  link.href = URL.createObjectURL(blob);
  link.download = fajlnev;
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
  URL.revokeObjectURL(link.href);
}

function feladat6() {
  const Szamlalo = {};

  for (let konyv of konyvek) {
    const dbszam = konyv.leiras;
    if (Szamlalo[dbszam]) {
      Szamlalo[dbszam]++;
    } else {
      Szamlalo[dbszam] = 1;
    }
  }
  let tobszorKiadot = [];
  Object.entries(Szamlalo).forEach(([kulcs, ertek]) => {
    if (ertek > 2) {
      tobszorKiadot.push(kulcs);
    }
  });
    let jok = []
  tobszorKiadot.forEach((y) => {
    let szamok = konyvek.filter((x) => x.leiras == y);
    let kezdo = szamok[0].peldanyszam
    let db = 0

    szamok.forEach((k) => {
      if(kezdo<k.peldanyszam)
      {
        db++
      }
    });
    if(db > 1)
      {
        jok.push(szamok[0].leiras)
      }
  });
  let valasz = "Legalább kétszer, nagyobb példányszámban újra kiadott könyvek: <br>"
  jok.forEach(x=>{
    valasz+=`${x}<br>`
  })
  document.getElementById("6feladat").innerHTML = `6.feladat:<br>${valasz}`
}
