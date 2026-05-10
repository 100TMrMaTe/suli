function feladat1() {
    let asd = document.getElementById("telepules").value;
    fetch("feladat1", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ telepules: asd,}),
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById("valasz1").innerText ="";
        data.nevek.forEach(x => {
            document.getElementById("valasz1").innerText += x;
        });
    });
}

function feladat2()
{
    let ora = document.getElementById("tantargy").value;
    fetch("feladat2",{
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            tantargy:ora,
        }),
    })
    .then(response => response.json())
    .then(data => {
        data.forEach(x=> {
            document.getElementById("valasz2").innerText += x["datum"]+"/"+x["terem"]+"/"+x["orasorszam"]+"\n";
        })
    })
}
function feladat3()
{
    let bet1 = document.getElementById("bet1").value;
    let bet2 = document.getElementById("bet2").value;

    fetch("feladat3",{
        method: "post",
        headers: {
            "Content-Type": "application/json",
        },
        body:JSON.stringify({
            bet1: bet1,
            bet2: bet2,
        }),
    })
    .then(response => response.json())
    .then(data => {
        data.forEach(x=> {
            document.getElementById("valasz3").innerText += x["csoport"]+"/"+x["targy"]+"/"+x["datum"]+"\n";
        })
    })
}

function feladat4()
{
    let telepules = document.getElementById("telep").value;
    fetch("feladat4",{
        method: "post",
        headers: {
            "Content-Type": "application/json",
        },
        body:JSON.stringify({
            telepules:telepules,
        }),
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById("valasz4").innerText = data["valasz"]["count(*)"];
    })
}
function feladat5(){
    fetch("feladat5")
    .then(response => response.json())
    .then(data => {
        console.log(data)
        data.forEach(x=>{
            document.getElementById("valasz5").innerText += x+" , ";
        })
    })
}

function init()
{
    feladat5()
}