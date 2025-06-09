<?php
include "../../mysqlconecta.php";

    $player = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drop de Items </title>
    <link rel="stylesheet" href="../../../css/game/bau.css">
    <link rel="stylesheet" href="../../../css/general/fonts.css">
</head>
<body>

    <div class="bau">

        <button onclick="gerar()" class="subtitle mediumT hobbit">Gerar loot</button>

    </div>

    <a href="mestre.php" class="sair subtitle">VOLTAR</a>

</body>
</html>