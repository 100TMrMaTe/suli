async function betolt() {
  let valasz = await fetch("https://fakestoreapi.com/products");
  let adatok = await valasz.json();
  console.log(adatok);
  for (let i = 0; i < adatok.length; i++) {
    let div = document.createElement("div");
    let tipus = document.createElement("p");
    tipus.innerHTML = adatok[i].category;
    let leiras = document.createElement("p");
    leiras.innerHTML = adatok[i].description;
    let kep = document.createElement("img");
    kep.setAttribute("src", adatok[i].image);
    function katt() {
      let ruhaAdatok = document.createElement("p")
      ruhaAdatok.innerHTML = JSON.stringify("Ára:"+adatok[i].price+" Leírás:"+adatok[i].title+" Rate:"+adatok[i].rating.rate)
      div.appendChild(ruhaAdatok)
      kep.removeEventListener("click",katt);
    }
    kep.addEventListener("click", katt);

    div.appendChild(tipus);
    div.appendChild(leiras);
    div.appendChild(kep);
    document.body.appendChild(div);
  }
}
