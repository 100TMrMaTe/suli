function get()
{
    fetch("table")
    .then(Response => Response.json())
    .then(x=>{
        document.getElementById("table").innerHTML = "";
        x.forEach(y => {
            let tr = `
            <tr>
                <td>${y["nev"]}</td>
                <td>${y["orszag"]}</td>
                <td>${y["nem"]}</td>
                <td>${y["szulev"]}</td>
                <td>${y["urido"]}</td>
                <td><button onclick="atiras(${y["id"]})">átirás</button></td>
                <td><button onclick="delete1(${y["id"]})">Delete</button></td>
            </tr>`

            document.getElementById("table").innerHTML += tr;
        });
    })
}


function atiras(id)
{

}

function delete1(ids)
{
    fetch("delete",{
        method:"DELETE",
        body:JSON.stringify({
            id:ids,
        })
    })
    .then(Response => Response.json())
    .then(x=>{
        if(x["status"] == "ok")
        {
            get();
        }
    })
}