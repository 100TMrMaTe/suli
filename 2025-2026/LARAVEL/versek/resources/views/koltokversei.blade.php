<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>

<body onload="loadApi()">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="../elsooldal">elsooldal</a>
                    <a class="nav-link" href="../koltok">koltok</a>
                    <a class="nav-link" href="../koltokversei">koltokversei</a>
                    <a class="nav-link" href="../koltokeszit">koltocsinal</a>
                    <a class="nav-link" href="../verscsinal">vers csinal</a>
                </div>
            </div>
        </div>
    </nav>
    <h1>Költő versei</h1>
    <div id="koltoadatai"></div>
    <ul id="versek">
    </ul>

    <script>
        let szam = window.location.href.substr(window.location.href.length - 1);
        window

        function loadApi() {
            fetch('/api/koltokversei/'+szam, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravelnél POST-hoz kellhet
                    },
                    body: JSON.stringify({
                        id: szam, // Az adat neve legyen 'id'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.kolto) {
                        // Költő adatainak kiírása
                        document.getElementById('koltoadatai').innerHTML = `
                <h2>${data.kolto.nev}</h2>
                <p>Született: ${data.kolto.szuletesi_hely}, ${data.kolto.szuletesi_datum}</p>
                <p>${data.kolto.eletrajz}</p>
            `;

                        // Versek listázása
                        const versekList = document.getElementById('versek');
                        versekList.innerHTML = '';
                        data.versek.forEach(vers => {
                            versekList.innerHTML += `
                    <li>
                        <h3>${vers.cim} (${vers.mufaj})</h3>
                        <pre>${vers.szoveg}</pre>
                    </li>
                `;
                        });
                    }
                });
        }
    </script>
</body>

</html>