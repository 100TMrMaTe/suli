function elso(id)
{
    fetch("elso/"+id,{
        method: "DELETE",
    })
    .then(Response => {
        if(Response.status == 200)
        {
            return Response.json()
        }
    })
    .then(y=> {
        console.log(y)
    })
}