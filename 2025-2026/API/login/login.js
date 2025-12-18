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
            if (valasz.status == "success") {
                localStorage.setItem("token", valasz.token);
                localStorage.setItem("expires", valasz.expires);
                document.getElementById("login").classList.add("d-none");
                document.getElementById("oldal").classList.remove("d-none");
            } else {
                alert(valasz.message);
            }
        });
}
function logincheck() {
    
    fetch("logincheck", {
        method: "GET",
        headers: {
            "authorization": `Bearer ${localStorage.getItem("token")}`,
            "Content-Type": "application/json",
        },
    })
    .then((x) => x.json())
    .then((valasz) => {
       console.log(valasz);
    });
}
