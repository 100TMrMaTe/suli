<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>osszeadas</h1>
    <button onclick="loadApi()">api hivas</button>
    <span>elso szam:</span>
    <input type="number" id="elso" name="elso"><br>
    <span>masodik szam:</span>
    <input type="number" id="masodik" name="masodik"><br>

    <pre id="apikimenet"></pre>

    <script>
        let elso = document.getElementById('elso').value;
        let masodik = document.getElementById('masodik').value;
        function loadApi() {
            fetch('/api/osszeadas', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    elso: elso,
                    masodik: masodik
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('apikimenet').textContent = JSON.stringify(data, null, 2);
            })
            .catch(error => {
                    console.error('Hiba az API hívás során:', error);
                });
        }
    </script>   
</body>
</html>