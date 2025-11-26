document.body.onload=init();

function init()
{
    console.log("start")
    document.getElementById("lista").innerHTML += todosor();
    document.getElementById("lista").innerHTML += todosor();
    document.getElementById("lista").innerHTML += todosor();
    document.getElementById("lista").innerHTML += todosor();
    document.getElementById("lista").innerHTML += todosor();
    document.getElementById("lista").innerHTML += todosor();

    todoBetolt();
}

function todoBetolt()
{
    fetch("todo")
        .then(x=>x.json())
        .then(y=>{
            console.log(y);
            console.log( document.getElementById("lista").innerHTML);
            //document.getElementById("lista").innerHTML = "";
            y.forEach(element => {
                document.getElementById("lista").innerHTML += todosor();
            });
        })
}


function todosor()
{
    return                  `<div class="card">
                                <div class="card-body bg-light text-dark rounded d-flex">
                                    <div class="col-9">
                                        <p class="card-text p-1">With supporting text below as a natural lead-in to additional content.</p>
                                    </div>
                                    <div class="col-3">
                                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                        <a href="#" class="btn btn-success btn-sm">Done</a>
                                    </div>
                                </div>
                            </div>`;
}