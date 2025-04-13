<?php
$play_num = isset($_GET["player"]) ? (int)$_GET["player"] : header("Location: players.php");



$_SESSION['play_num'] = $play_num;
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
<?php

include "../mysqlconecta.php";


    $query = "SELECT pla_nome, pla_classe, pla_reino FROM players ORDER BY pla_reino, pla_nome";
    $result = mysqli_query($conexao, $query);

    $reino1 = [];
    $reino2 = [];

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['pla_reino'] == 1) {
            $reino1[] = $row;
        } else if ($row['pla_reino'] == 2) {
            $reino2[] = $row;
        }
    }

?>
<div class="main-container">

    <div class="container">
        <h1 class="subtitle">Time 1</h1>
        <?php
        for ($i = 0; $i < $play_num; $i++) {
            if (isset($reino1[$i])) {
                $player = $reino1[$i];
                echo "<div class='mini-container text'>{$player['pla_nome']} - {$player['pla_classe']}</div>";
            } else {
                echo "<div class='mini-container text'>Jogador " . ($i + 1) . "</div>";
            }
        }
        ?>
    </div>

    <div class="containerQr">
        <img class="qr" src="qr.php" alt="QR Code">
        <h2 class="subtitle">Quando todos os jogadores estiverem cadastrados aperte F5</h2>
    </div>

    <div class="container">
        <h1 class="subtitle">Time 2</h1>
        <?php
        for ($i = 0; $i < $play_num; $i++) {
            if (isset($reino2[$i])) {
                $player = $reino2[$i];
                echo "<div class='mini-container text'><span class='bold'>{$player['pla_nome']}</span> | {$player['pla_classe']}</div>";
            } else {
                echo "<div class='mini-container text'>Jogador " . ($i + 1 + $play_num) . "</div>";
            }
        }
        ?>
</div>

</div>


</body>
</html>
