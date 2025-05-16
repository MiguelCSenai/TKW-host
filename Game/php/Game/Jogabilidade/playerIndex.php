<?php
session_start();


if (isset($_SESSION['player_id'])) {
    
    include "../../mysqlconecta.php";
    
    $player_id = $_SESSION['player_id'];
    $sql = "SELECT * FROM players WHERE pla_id = {$player_id}";
    $result = mysqli_query($conexao, $sql);
    $player = mysqli_fetch_assoc($result);

    if ($_SESSION['setup']) {
        $_SESSION['max_hp'] = $player['pla_HP'];
        $_SESSION['setup'] = false;
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Ficha de Personagem</title>
    <link rel="stylesheet" href="../../../css/game/ficha.css">
    <link rel="stylesheet" href="../../../css/general/fonts.css">
    <link rel="stylesheet" href="../../../css/general/attributes.css">
</head>
<body>

    <div class="container-personagem">
        <div class="img">
            <div class="level-container"><?php echo $player['pla_lvl']; ?></div>
        </div>
        <p class="subtitle bold mediumT"><?php echo $player['pla_nome']; ?></p>
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

        <p class="subtitle bold">Prisioneiro do reino <?php echo $player['pla_reino']; ?></p>  

    </div>

    <div class="button-container">
            <div class="icon-button" id="inventario">
                <img src="../../../resources/img/inventario.png" alt="Inventário" class="icon-img">
            </div>
            <div class="icon-button" id="combate">
                <img src="../../../resources/img/combate.png" alt="Combate" class="icon-img">
            </div>
            <div class="icon-button" id="magia">
                <img src="../../../resources/img/magia.png" alt="Magia" class="icon-img">
            </div>
            <!--<div class="icon-button" id="movimento">
                <img src="../../../resources/img/movimento.png" alt="Magia" class="icon-img">
            </div>-->
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
            $max = ($key === "pla_HP") && isset($_SESSION) ? $_SESSION['max_hp'] : 30;
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

<script>

document.addEventListener('DOMContentLoaded', function() {
    // Adiciona ouvintes de clique para cada botão
    const buttons = document.querySelectorAll('.icon-button');
    
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const buttonId = this.id;
            switch (buttonId) {
                case 'inventario':
                    window.location.href = 'inventario.php';
                    break;
                case 'combate':
                    window.location.href = 'armas.php';
                    break;
                case 'magia':
                    window.location.href = 'magia.php';
                    break;
                case 'movimento':
                    window.location.href = 'movimento.php';
                    break;
            }
        });
    });
});

</script>