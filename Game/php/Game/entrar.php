<?php
$play_num = isset($_GET["player"]) ? (int)$_GET["player"] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/game/players.css">
    <link rel="stylesheet" href="../../css/general/fonts.css">
    <link rel="stylesheet" href="../../css/general/elements.css">
    <link rel="stylesheet" href="../../css/general/attributes.css">
    <title>Entrar</title>
</head>
<body>

<div class="main-container">

    <div class="container">
        <h1 class="subtitle">Time 1</h1>
        <?php for ($i = 1; $i <= $play_num; $i++): ?>
            <div class="mini-container text">Jogador <?= $i ?></div>
        <?php endfor; ?>
    </div>

    <div class="containerQr">

        <img class="qr" src="qr.php" alt="QR Code">
        <h2 class="subtitle">Quando todos os jogadores estiverem cadastrados aperte F5</h2>

    </div>

    <div class="container">
        <h1 class="subtitle">Time 2</h1>
        <?php for ($i = 1; $i <= $play_num; $i++): ?>
            <div class="mini-container text">Jogador <?= $i + $play_num ?></div>
        <?php endfor; ?>
    </div>

</div>

</body>
</html>
