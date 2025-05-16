<?php
session_start();
include "../../mysqlconecta.php";

$player_id = $_SESSION['player_id'];

$query_armas = "SELECT a.wpn_id, a.wpn_nome, a.wpn_tipo, a.wpn_natureza, a.wpn_efeito,
                       a.wpn_dano, a.wpn_velocidade, a.wpn_alcance, a.wpn_icone, a.wpn_descricao
                FROM armas a
                JOIN inventario inv ON a.wpn_id = inv.wpn_id
                WHERE inv.pla_id = {$player_id}";

$result = mysqli_query($conexao, $query_armas);

$armas = [];

while ($row = mysqli_fetch_assoc($result)) {
    $armas[] = $row;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Ficha de Personagem - Armas</title>
    <link rel="stylesheet" href="../../../css/game/inventario.css">
    <link rel="stylesheet" href="../../../css/general/fonts.css">
    <link rel="stylesheet" href="../../../css/general/attributes.css">
</head>
<body style="padding:0;">

        <?php foreach ($armas as $arma): ?>
            <?php
                switch ($arma['wpn_natureza']) {
                    case 'Base':
                        $classe = "grayB dark-grayBC white";
                        $classeImg = "base";
                        break;
                    case 'Sangue':
                        $classe = "redB dark-redBC white";
                        $classeImg = "sangue";
                        break;
                    case 'Vísceras':
                        $classe = "light-purpleB purpleBC white";
                        $classeImg = "visceras";
                        break;
                    case 'Ossos':
                        $classe = "whiteB grayBC black";
                        $classeImg = "ossos";
                        break;
                    case 'Consciência':
                        $classe = "light-blueB blueBC darkBlue";
                        $classeImg = "consciencia";
                        break;
                    default:
                        $classe = "grayB dark-grayBC white";
                        $classeImg = "base";
                        break;
                }
            ?>
            <div class="<?= $classe ?> solid mediumBS arma text">
                <div class="icon">
                    <img class="<?= $classeImg ?>" src="<?= $arma['wpn_icone'] ?>" alt="<?= $arma['wpn_nome'] ?>">
                    <h2><?= $arma['wpn_nome'] ?></h2>
                </div>
                <div class="content">
                    <div class="stats">
                        <p><strong class="subtitle">Tipo:</strong> <?= $arma['wpn_tipo'] ?></p>
                        <p><strong class="subtitle">Natureza:</strong> <?= $arma['wpn_natureza'] ?></p>
                        <p><strong class="subtitle">Efeito:</strong> <?= $arma['wpn_efeito'] ?></p>

                        <div class="dano">
                            <strong class="subtitle">Dano:</strong>
                            <div class="stat-bar">
                                <span class="stat-num"><?= min($arma['wpn_dano'], 10) ?> / 10</span>
                                <div class="stat-fill" style="width: <?= min($arma['wpn_dano'], 10) * 10 ?>%"></div>
                            </div>
                        </div>

                        <div class="velocidade">
                            <strong class="subtitle">Velocidade:</strong>
                            <div class="stat-bar">
                                <span class="stat-num"><?= min($arma['wpn_velocidade'], 4) ?> / 4</span>
                                <div class="stat-fill" style="width: <?= min($arma['wpn_velocidade'], 4) * 25 ?>%"></div>
                            </div>
                        </div>

                        <div class="alcance">
                            <strong class="subtitle">Alcance:</strong>
                            <div class="stat-bar">
                                <span class="stat-num"><?= min($arma['wpn_alcance'], 10) ?> / 10</span>
                                <div class="stat-fill" style="width: <?= min($arma['wpn_alcance'], 10) * 10 ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    <a href="playerIndex.php" class="voltar subtitle">Voltar</a>

</body>
</html>
