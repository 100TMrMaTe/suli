function osztoSzam(szam) {
  let szamOsztoDb = 0;
  for (let i = 1; i <= szam; i++) {
    if (szam % i === 0) {
      szamOsztoDb++;
    }
  }
  return szamOsztoDb;
}

let szam = 0
function vizsga()
{
 szam = Number(document.getElementById("szamBeker").value)
 if(szam >= 2 && szam <= 100 && !isNaN(szam))
 {
    szamitas()
 }
 else{
  alert("A szám nem helyes!")
 }
}




function szamitas() {
  let kevesebbOsztojuSzamok = [];
  for (let i = 2; i <= 100; i++) {
    if (osztoSzam(i) < osztoSzam(szam)) {
      kevesebbOsztojuSzamok.push(i);
    }
  }
  if (kevesebbOsztojuSzamok.length === 0) {
    document.body.innerHTML =
      '<div id="kijelzo">A megadott számnál nincsen kisebb osztószámmal rendelkező szám csak egyenlő.</div>';
  } else {
    document.body.innerHTML =
      '<div id="kijelzo">A megadott számnál kevesebb osztóval rendelkező számok: ' +
      kevesebbOsztojuSzamok.join(",") +
      '</div>';
  }
}
