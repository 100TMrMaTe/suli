function rajz() {
  let tervRajzBekert = document.getElementById("beKeres").value.trim();
  let tervRajz = tervRajzBekert.split(/\s+/).map(Number);

  let szelesseg = tervRajz[0];
  let magassag = tervRajz[1];
  tervRajz = tervRajz.slice(2);

  let tabla = document.createElement("table");
  for (let i = 0; i < magassag; i++) {
    let sor = document.createElement("tr");
    for (let j = 0; j < szelesseg; j++) {
      let cella = document.createElement("td");
      if (tervRajz[i * szelesseg +j] === 1) {
        cella.style.backgroundColor = "black";
      } else {
        cella.style.backgroundColor = "white";
      }
      sor.appendChild(cella);
    }
    tabla.appendChild(sor);
  }
  document.body.appendChild(tabla);
  document.body.innerHTML += '<br />'
}
