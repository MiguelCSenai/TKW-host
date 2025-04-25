<?php
session_start();

if (isset($_SESSION['classe']) && isset($_SESSION['nome']) && isset($_SESSION['reino'])) {

    include "../../mysqlconecta.php";

    $nome = $_SESSION['nome'];
    $sql = "SELECT pla_HP, pla_STR, pla_AGI, pla_INT, pla_lvl, pla_xp FROM players WHERE pla_nome = ?";
    $nome = $_SESSION['nome'];
    $sql = "SELECT * FROM players WHERE pla_nome = '$nome'";
    $result = mysqli_query($conexao, $sql);
    $player = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Ficha de Personagem</title>
    <link rel="stylesheet" href="../../../css/game/mobile.css">
    <link rel="stylesheet" href="../../../css/general/fonts.css">
    <link rel="stylesheet" href="../../../css/general/attributes.css">
</head>
<body>

    <div class="container-personagem">
        <div class="img"><?php echo $_SESSION['classe']; ?>
            <div class="level-container"><?php echo $player['pla_lvl']; ?></div>
        </div>
        <p class="subtitle bold mediumT"><?php echo $_SESSION['nome']; ?></p>
        <div class="xp-container">
            <?php
                $xp = $player['pla_xp'];
                $xpMax = 10 * $player['pla_lvl'];
                $xpPercent = min(100, ($xp / $xpMax) * 100);
            ?>
            <div class="xp-bar">
                <div class="xp-fill" style="width: <?php echo $xpPercent; ?>%;"></div>
                <div class="xp-text"><?php echo $xp; ?> / <?php echo $xpMax; ?> XP</div>
            </div>
        </div>
        <div class="button-container">
    <div class="icon-button">
        <img src="../../../resources/img/inventario.png" alt="Inventário" class="icon-img">
    </div>
    <div class="icon-button">
        <img src="../../../resources/img/combate.png" alt="Combate" class="icon-img">
    </div>
</div>

        <p class="subtitle bold">Prisioneiro do reino <?php echo $_SESSION['reino']; ?></p>  

    </div>

    <div class="stats">
        <?php
        $stats = [
            "pla_HP" => "HP",
            "pla_STR" => "FOR",
            "pla_AGI" => "AGI",
            "pla_INT" => "INT"
        ];

        foreach ($stats as $key => $atributo) {
            $valor = $player[$key];
            $max = ($key === "pla_HP") ? $_SESSION['max_hp'] : 30;
            $porcentagem = min(100, ($valor / $max) * 100);
            echo "
            <div class='stat'>
                <strong class='subtitle'>{$atributo}:</strong>
                <div class='stat-bar'>
                    <span class='stat-num'>{$valor} / {$max}</span>
                    <div class='stat-fill' style='width: {$porcentagem}%;'></div>
                </div>
            </div>
            ";
        }
        
        ?>
    </div>

</body>
</html>

<?php 
} else {
    header("Location: ../cadastro.php");
    exit;
}
?>
