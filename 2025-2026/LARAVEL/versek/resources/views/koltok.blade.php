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
                    <a class="nav-link active" aria-current="page" href="koltok">koltok</a>
                    <a class="nav-link" href="koltokversei">koltokversei</a>
                    <a class="nav-link" href="koltokeszit">koltocsinal</a>
                    <a class="nav-link" href="verscsinal">vers csinal</a>
                </div>
            </div>
        </div>
    </nav>
    <h1>Költők</h1>
    <ul id="koltok">
        <li>Ady Endre</li>
        <li>József Attila</li>
        <li>Petőfi Sándor</li>
        <li>Arany János</li>
        <li>Babits Mihály</li>
    </ul>
    <script>
        function atiranyitas(id) {
            window.location.href = `/koltokversei/${id}`;
        }

        function licsinal(id, kolto) {
            return `
            <li onclick="atiranyitas(${id})">${kolto}</li>
            `
        }

        fetch('/api/koltok', {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const koltokList = document.getElementById('koltok');
                koltokList.innerHTML = '';

                data.forEach(kolto => {
                    koltokList.innerHTML += licsinal(kolto.id, kolto.nev);
                });
            })
    </script>
</body>

</html>