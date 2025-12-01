document.body.onload = init();

function init() {
    //console.log("start")
    document.getElementById("lista").innerHTML += todosor();
    document.getElementById("lista").innerHTML += todosor();

    todoBetolt();
}

function todoBetolt() {
    fetch("todo/")
        .then(x => x.json())
        .then(y => {
            //console.log(y);
            //console.log( document.getElementById("lista").innerHTML);
            document.getElementById("lista").innerHTML = "";
            y.forEach(element => {
                //console.log(element)
                document.getElementById("lista").innerHTML += todosor(element.szoveg, element.id);
            });
        })
}


function todosor(szoveg, id) {
    return `<div class="card">
                                <div class="card-body bg-light text-dark rounded d-flex">
                                    <div class="col-9">
                                        <p class="card-text p-1">${szoveg}</p>
                                    </div>
                                    <div class="col-3">
                                        <a href="#" class="btn btn-danger btn-sm" data-id="${id}" onclick="torol(this)">Delete</a>
                                        <a href="#" class="btn btn-success btn-sm">Done</a>
                                    </div>
                                </div>
                            </div>`;
}

function hozzaad() {
    //console.log("time")
    let szoveg = document.getElementById("szoveg").value;
    //console.log(szoveg)

    let json = {
        memberid: "asdadas",
        feladat: szoveg
    }

    fetch("todo/", {
        method: "POST",
        body: JSON.stringify(json)
    })
        .then(x => x.json())
        .then(y => {
            if (y.status == "success") {
                document.getElementById("szoveg").value = "";
                todoBetolt();
            }
            else {
                console.log(y);
                document.getElementById("error").innerText = y.errormassage;
                document.getElementById("error").classList.remove("d-none");
                setTimeout(() => {
                    document.getElementById("error").innerText = "";
                    document.getElementById("error").classList.add("d-none");
                }, 5000)
            }
        })
}
function torol(elem)
{
    console.log("jo",elem);
    fetch("todo/"+ elem.dataset.id, {
        method: "DELETE",
        body: JSON.stringify(json)
    })
        .then(x => x.json())
        .then(y => {
            if (y.status == "success") {
                todoBetolt();
            }
            else {
                console.log(y);
                document.getElementById("error").innerText = y.errormassage;
                document.getElementById("error").classList.remove("d-none");
                setTimeout(() => {
                    document.getElementById("error").innerText = "";
                    document.getElementById("error").classList.add("d-none");
                }, 5000)
            }
        })
}