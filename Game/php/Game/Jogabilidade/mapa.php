<?php
session_start();
include "../../mysqlconecta.php";

$sessao = $_SESSION['ses_id'];

$players = [];
$query = "SELECT pla_nome, pla_classe, pla_x, pla_y, pla_bloco, pla_reino FROM players WHERE pla_ses_id = $sessao";
$result = mysqli_query($conexao, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $players[] = $row;
    }
}

// Separar os jogadores por reino
$reino1 = array_filter($players, function($p) { return $p['pla_reino'] == 1; });
$reino2 = array_filter($players, function($p) { return $p['pla_reino'] == 2; });

// Cores para cada reino
$coresReino1 = ['#4A90E2', '#50E3C2', '#9013FE', '#B8E986']; // frias
$coresReino2 = ['#F5A623', '#D0021B', '#F8E71C', '#F56A79']; // quentes
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The King's Will</title>
    <link rel="stylesheet" href="../../../css/game/settings.css">
    <link rel="stylesheet" href="../../../css/general/fonts.css">
    <link rel="stylesheet" href="../../../css/game/elements/components.css">
    <link rel="stylesheet" href="../../../css/game/elements/animations.css">
    <link rel="stylesheet" href="../../../css/game/mapa.css">
    <style>
        .lista-jogadores {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 20px;
            width: 200px;
        }
        .player-nome {
            padding: 5px 10px;
            border-radius: 8px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container-mapa">
    <div class="linha-mapa">
        <!-- Lista do Reino 1 -->
        <div class="bloco esquerda">
            <div class="lista-jogadores">
                <?php 
                $i = 0;
                foreach ($reino1 as $player) {
                    $cor = $coresReino1[$i % count($coresReino1)];
                    echo "<div class='player-nome subtitle' style='background-color: $cor;'>{$player['pla_nome']} | {$player['pla_classe']}</div>";
                    $i++;
                }
                ?>
            </div>
        </div>

        <div class="grid-centro">
            <?php for ($bloco = 1; $bloco <= 9; $bloco++) { ?>
                <div class="bloco-centro">
    <div class="grid-celulas">
        <?php
        for ($linha = 1; $linha <= 15; $linha++) {
            for ($coluna = 1; $coluna <= 15; $coluna++) {
                echo "<div class='celula' data-linha='$linha' data-coluna='$coluna'></div>";
            }
        }
        ?>
    </div>

    <?php
    // Jogadores deste bloco
    foreach ($players as $player) {
        if ($player['pla_bloco'] == $bloco) {
            $left = ($player['pla_x'] - 1) * (250 / 15); // 250px é o tamanho do bloco-centro
            $top = ($player['pla_y'] - 1) * (250 / 15);

            // Definir cor
            $cor = ($player['pla_reino'] == 1) ? $coresReino1[0] : $coresReino2[0];

            echo "<div class='player-icon' style='left: {$left}px; top: {$top}px; background-color: $cor;' title='{$player['pla_nome']}'></div>";
        }
    }
    ?>
</div>
            <?php } ?>
        </div>

        <!-- Lista do Reino 2 -->
        <div class="bloco direita">
            <div class="lista-jogadores">
                <?php 
                $i = 0;
                foreach ($reino2 as $player) {
                    $cor = $coresReino2[$i % count($coresReino2)];
                    echo "<div class='player-nome subtitle' style='background-color: $cor;'>{$player['pla_nome']} | {$player['pla_classe']}</div>";
                    $i++;
                }
                ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<?php
mysqli_close($conexao);
?>
