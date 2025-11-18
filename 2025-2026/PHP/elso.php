<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ez egy cím</h1>
    <?php
        echo "Lajos a kukac";
        $alma ="<br><b>Jonatán</b>";
        echo $alma;
        $alma = $alma . " valami ";
        echo $alma;
        $alma = 1;
        echo $alma++;
        echo ++$alma;
        echo "<br> szám: $alma";

        echo"<pre>";
        var_dump($alma);
        echo"</pre>";

        $alma = "kalapács";
        echo"<pre>";
        var_dump($alma);
        echo"</pre>";

        $alma = 3.14;
        echo"<pre>";
        var_dump($alma);
        echo"</pre>";

        $alma = true;
        echo"<pre>";
        var_dump($alma);
        echo"</pre>";

        for($i = 0; $i < 10; $i++)
        {
            echo "$i<br>";
        }

        $i=0;
        while($i < 10)
        {
            echo $i.",";
            $i++;
        }

        $tomb=["alam","körte","Pap Laci 2"];
        echo "<br>";
        $tomb[3] = 1425;
        $tomb["asd"] = "kgjgjng";
        var_dump($tomb)

        


        ?>
</body>
</html>