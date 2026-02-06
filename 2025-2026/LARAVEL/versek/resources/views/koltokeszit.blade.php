<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="elsooldal">elsooldal</a>
                    <a class="nav-link" href="koltok">koltok</a>
                    <a class="nav-link" href="koltokversei">koltokversei</a>
                    <a class="nav-link  active" aria-current="page" href="koltokeszit">koltocsinal</a>
                    <a class="nav-link" href="verscsinal">vers csinal</a>
                </div>
            </div>
        </div>
    </nav>
    <h1>koltokeszit</h1>
    <label>nev:</label>
    <input type="text" id="nev"><br>
    <label>mikor szuletett:</label>
    <input type="date" id="szuldate"><br>
    <label>hol szuletett:</label>
    <input type="text" id="szulhely"><br>
    <label>meghalt:</label>
    <input type="date" id="meghalt"><br>
    <label>meghalt hely:</label>
    <input type="text" id="meghalthely"><br>
    <label>eletrajz:</label>
    <input type="text" id="eletrajz"><br>
    <button onclick="kuldes()">elkuld</button>

    <script>
        function kuldes() {
            let nev = document.getElementById("nev").value;
            let szuldate = document.getElementById("szuldate").value;
            let szulhely = document.getElementById("szulhely").value;
            let meghalthely = document.getElementById("meghalt").value;
            let meghaltdate = document.getElementById("meghalthely").value;
            let eletrajz = document.getElementById("eletrajz").value;

            fetch('/api/koltokeszit', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json', // Laravelnél POST-hoz kellhet
                    },
                    body: JSON.stringify({
                        nev: nev,
                        szuldate: szuldate,
                        szulhely: szulhely,
                        meghalthely: meghalthely,
                        meghaltdate: meghaltdate,
                        eletrajz: eletrajz
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if(data.status == "ok")
                    {
                        alert("good")
                    }
                    else
                    {
                        alert("valami nagyonelvan baszodva")
                    }
                })
        }
    </script>
</body>

</html>