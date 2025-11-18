<?php
    include("fugvenyek.php");
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Weblap Feladat</title>
</head>

<body>

<div class="container-lg">
    <div class="row">
        <div class="col-sm-12 text-center">
            <div class="display-1"><?php
            echo $adatok["cim"][rand(0,sizeof($adatok["cim"])-1)];
            ?></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 p-2">
            <div class="card w-100" >
                <div class="card-body">
                    <h5 class="card-title"><?php
                    echo $adatok["kartya"]["cim"][rand(0,sizeof($adatok["kartya"]["cim"])-1)];
                    ?></h5>
                    <p class="card-text"><?php
                    echo $adatok["kartya"]["szoveg"][rand(0,sizeof($adatok["kartya"]["szoveg"])-1)];
                    ?></p>
                    <a href="<?php
                    $adatok["kartya"]["link"][rand(0,sizeof($adatok["kartya"]["link"])-1)];
                    ?>" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-sm-8 p-2">
            <nav class="navbar navbar-light bg-light">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">Navbar</span>
                </div>
            </nav>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vulputate felis quis sollicitudin laoreet. Cras risus felis, sodales ultrices tellus a, aliquam semper dolor. Nunc ac tincidunt libero, ut rutrum elit.<img src="images.jpg" class=" rounded img-fluid float-end">Cras tristique, justo eget pharetra finibus, diam leo finibus arcu, vel volutpat orci mauris sit amet massa. Etiam porta id ante et vestibulum. Etiam aliquam commodo lobortis. Mauris tincidunt viverra tristique. Nullam eget magna a lorem rutrum semper eget et dolor.</p>
            
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 justify-content-center p-2">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><?php
                    echo $adatok["kartya"]["cim"][rand(0,sizeof($adatok["kartya"]["cim"])-1)];
                    ?></h5>
                    <p class="card-text"><?php
                    echo $adatok["kartya"]["szoveg"][rand(0,sizeof($adatok["kartya"]["szoveg"])-1)];
                    ?></p>
                    <a href="<?php
                    $adatok["kartya"]["link"][rand(0,sizeof($adatok["kartya"]["link"])-1)];
                    ?>" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-sm-8 p-2">
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit.<img src="images2.jpg" class="rounded img-fluid float-start"> Duis vulputate felis quis sollicitudin laoreet. Cras risus felis, sodales ultrices tellus a, aliquam semper dolor. Nunc ac tincidunt libero, ut rutrum elit. Cras tristique, justo eget pharetra finibus, diam leo finibus arcu, vel volutpat orci mauris sit amet massa. Etiam porta id ante et vestibulum. Etiam aliquam commodo lobortis. Mauris tincidunt viverra tristique. Nullam eget magna a lorem rutrum semper eget et dolor.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 p-2">
            <footer class="bg-dark text-white text-center">
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam a.</p>
            </footer>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>