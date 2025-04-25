<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The King's Will | História</title>
    <link rel="stylesheet" href="../../css/general/attributes.css">
    <link rel="stylesheet" href="../../css/general/fonts.css">
    <link rel="stylesheet" href="../../css/general/elements.css">
    <link rel="stylesheet" href="../../css/wiki/style.css">
    <link rel="stylesheet" href="../../css/menu/style.css">
    <link rel="stylesheet" href="../../css/home/animations.css">
    <script src="../../js/Wiki/transitions.js"></script>
</head>
<body id="body" class="removeScroll">

    <nav class="menu subtitle bold noSelect">
        <ul>
            <li><a href="../home.php">Home</a></li>
            <li><a href="../Catalogo/catalogo.php">Catálogo</a></li>
            <li><a>Como Jogar</a></li>
            <li><a onclick="ativarTransicao()">História</a></li>
            <li><a href="../../../Game/php/MainMenu/main.php">Jogar</a></li>
            <li><a href="../Admin/menu.php"><?php if (isset($_SESSION['admin'])) { echo $_SESSION['admin']; }else{ echo "Administrador"; } ?></a></li>

        </ul>
        <img class="noSelect" src="../../resources/Livro.png" id="overlay">
            <div onclick="desativarTransicao()" id="overlayBackground"></div>
            <script src="../../js/General/transitions.js"></script>
    </nav>

</body>
</html>