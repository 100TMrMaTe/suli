var kepekurl = [
  "1.jpg",
  "2.jpg",
  "3.jpg",
  "4.jpg",
  "5.jpg",
  "6.jpg"
];
var pardb = 6;
function init() {
  kepkirakas();
}
var kattintas = 0;
let lathatolapok = [];
const megtalaltparok = [];
function kepkirakas() {
  let asztal = document.getElementById("asztal");

  let kartyak = [];

  for (let j = 0; j < 2; j++) {
    for (let i = 0; i < pardb; i++) {
      let uj = document.createElement("div");
      uj.className = "kartya";
      uj.dataset.hatterkep = "url(kepek/" + kepekurl[i] + ")";
      uj.onclick = function () {
        if (
          lathatolapok.length > 1 ||
          lathatolapok.includes(this) ||
          megtalaltparok.includes(this)
        ) {
          return;
        }

        if (kattintas === 0) {
          orastart();
        }
        kattintas++;
        document.getElementById("kattintasok").innerHTML =
          "Kattintások száma: " + kattintas;

        lathatolapok.push(this);
        this.style.backgroundImage = this.dataset.hatterkep;

        if (lathatolapok.length < 2) {
          return;
        }

        if (
          lathatolapok[0].style.backgroundImage !==
          lathatolapok[1].style.backgroundImage
        ) {
          setTimeout(visszafordit, 2000);
          return;
        }

        megtalaltPar();
      };

      kartyak.push(uj);
    }
  }

  kartyak = kever(kartyak);

  for (let i = 0; i < kartyak.length; i++) {
    asztal.appendChild(kartyak[i]);
  }
}

function megtalaltPar() {
  megtalaltparok.push(...lathatolapok);
  lathatolapok = [];

  if (!vanemeg()) {
    nyertel();
  }
}

function visszafordit() {
  for (const lap of lathatolapok) {
    lap.style.backgroundImage = "";
  }

  lathatolapok = [];
}

let starttime = "";
let timer;
function orastart() {
  starttime = new Date();

  timer = setInterval(orashow, 100);
}
function orashow() {
  const aktualtume = new Date();

  const kulonbseg = aktualtume - starttime;

  const ido = new Date(kulonbseg);
  const mp = ido.getSeconds();
  const perc = ido.getMinutes();

  document.getElementById("ido").innerHTML =
    perc +
    ":" +
    (mp < 10 ? "0" : "") +
    mp +
    "." +
    Math.floor(ido.getMilliseconds() / 100);
}

function nyertel() {
  let uj = document.createElement("div");
  uj.innerHTML = "Gratulálunk nyertél!";
  uj.setAttribute("id","jatekVege")
  document.getElementsByTagName("header")[0].appendChild(uj);
  clearInterval(timer);
}

function vanemeg() {
  let db = 0;
  const lapok = document.getElementById("asztal").children;
  for (let i = 0; i < lapok.length; i++) {
    if (lapok[i].style.backgroundImage === "") {
      db++;
    }
  }
  return db > 0;
}

function kever(points) {
  for (let i = points.length - 1; i > 0; i--) {
    let j = Math.floor(Math.random() * (i + 1));
    let k = points[i];
    points[i] = points[j];
    points[j] = k;
  }
  return points;
}
