function feladat2() {
    fetch("index.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "2",
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            console.log(valasz);
        });
}

function feladat3(){
    fetch("index.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "3",
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            console.log(valasz);
        });
}

function feladat4(){
    let beker = document.getElementById("beker").value;

    fetch("index.php", {
        method: "POST",
        body: JSON.stringify({
            feladat: "4",
            beker: beker,
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            console.log(valasz);
        });
}