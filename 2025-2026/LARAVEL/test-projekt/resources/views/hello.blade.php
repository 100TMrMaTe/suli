<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello, World!</h1>
    <?php

use Symfony\Component\VarDumper\VarDumper;

    echo "This is a simple Blade template in Laravel.";
    VarDumper::dump(['message' => 'This is a debug message from VarDumper.']);
    ?>
</body>
</html>