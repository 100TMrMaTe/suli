const { jsx } = require("react/jsx-runtime");

fetch(fgh,{
    method:"POST",
    body:JSON.stringify({
        as:as,
        ad:ad,
    })
})
.then(Response => {
    if(Response.status == 200)
    {
        return Response.json();
    }
})
.then(x=> {
    console.log(x)
})