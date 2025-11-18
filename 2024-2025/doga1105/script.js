function feladat1() {
  let naygKeret = document.getElementById("nagyKeret");
  let keret = document.createElement("div");
  keret.setAttribute("id", "keret");
  let szovegMezo = document.createElement("input");
  szovegMezo.setAttribute("id", "szoveg");

  let torol = document.createElement("button");
  torol.textContent = "X";
  torol.addEventListener("click", function () {
    keret.remove();
  });
  let fel = document.createElement("button");
  fel.addEventListener("click", function () {
    if (this.parentNode.previousSibling !== null)
      this.parentNode.parentNode.insertBefore(
        this.parentNode,
        this.parentNode.previousSibling
      );
  });
  fel.textContent = "↑";
  let le = document.createElement("button");
  le.textContent = "↓";
  le.addEventListener("click", function () {
    if (this.parentNode.nextSibling !== null)
      this.parentNode.parentNode.insertBefore(
        this.parentNode.nextSibling,
        this.parentNode
      );
  });
  szovegMezo.addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
      if (szovegMezo.value === "") {
        alert("Valami kell a mezőbe!");
      } else {
        let szoveg = document.createElement("label");
        szoveg.textContent = szovegMezo.value;
        szoveg.addEventListener("dblclick", function () {
          keret.replaceChild(szovegMezo, keret.childNodes[0]);
        });
        keret.replaceChild(szoveg, keret.childNodes[0]);
      }
    }
  });
  keret.appendChild(szovegMezo);
  keret.appendChild(torol);
  keret.appendChild(fel);
  keret.appendChild(le);
  document.getElementById("nagyKeret").appendChild(keret);
  szovegMezo.focus();
}
