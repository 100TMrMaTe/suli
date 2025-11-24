<button onclick="f2()">Click me</button>
<div id="ide"></div>
<?php
phpinfo(32);
?>
<script>
    function f2() {
        fetch("suliscucc/suli/2025-2026/PHP/api/123/123/123")
            .then(response => response.text())
            .then(data => {
                m(data);
            });
    }

    function m(massage)
    {
        document.getElementById("ide").innerHTML = massage;
    }
</script>