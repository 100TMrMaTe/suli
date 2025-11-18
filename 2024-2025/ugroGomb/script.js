function feladat1() {
    let gombocska = document.getElementById("Gomb")
    let balrol = Math.floor(Math.random() * (window.innerHeight - gombocska.offsetHeight))
    let fent = Math.floor(Math.random() * (window.innerWidth - gombocska.offsetWidth))
    gombocska.style.position = "absolute"
    gombocska.style.left = fent + "px"
    gombocska.style.top = balrol + "px"
}
function csalo() {
    alert("Haló báttya!")
    document.getElementById("Gomb").blur()
}
function gyozelem()
{
    alert("Há hugy az anyámba?")
}