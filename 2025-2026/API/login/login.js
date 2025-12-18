function login() {
    let nev = document.getElementById("nev").value;
    let password = document.getElementById("password").value;

    fetch("login", {
        method: "POST",
        body: JSON.stringify({
            nev: nev,
            password: password,
        }),
    })
        .then((x) => x.json())
        .then((valasz) => {
            console.log(valasz);
        });
}
