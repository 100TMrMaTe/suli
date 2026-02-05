<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Dashboard</h1>
    <button onclick="loadApi()">api hivas</button>

    <pre id="apikimenet"></pre>

    <script>
        function loadApi() {
            fetch('/api/test')
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