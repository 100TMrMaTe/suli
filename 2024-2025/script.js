$.ajax(
    {
        url: "https://fakestoreapi.com/products",
        dataType: "json",
        success: function (data){
            //console.log(data)
            data.forEach(element => {
                console.log(element.price)
            });
        }
    }
)