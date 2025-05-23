<?php session_start();
include "../../mysqlconecta.php";


    $sessao = $_SESSION['ses_id'];

    $query_players = "SELECT pla_id, pla_nome, pla_classe, pla_lvl, pla_xp, pla_HP FROM players WHERE pla_ses_id = $sessao";
    $result_players = mysqli_query($conexao, $query_players);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Players</title>
    <link rel="stylesheet" href="../../../css/general/fonts.css">
    <link rel="stylesheet" href="../../../css/game/elements/components.css">
    <link rel="stylesheet" href="../../../css/game/elements/animations.css">
    <link rel="stylesheet" href="../../../css/game/elements/attributes.css">
    <link rel="stylesheet" href="../../../css/game/status.css">
</head>
<body>
    
    <div class="container">

        <?php
        
            if(mysqli_num_rows($result_players) > 0){

                while ($row = mysqli_fetch_assoc($result_players)) {?>

                    <div onclick="ver(<?= $row['pla_id'] ?>)" class="player">

                        <h1 class="nome subtitle red bold"><?= $row['pla_nome'] ?></h1>
                        <div class="container-level">

                            <div class="xp-container">
                                <?php
                                    $xp = $row['pla_xp'];
                                    $xpMax = 10 * $row['pla_lvl'];
                                    $xpPercent = min(100, ($xp / $xpMax) * 100);
                                ?>
                                <div class="xp-bar">
                                    <div class="xp-fill" style="width: <?php echo $xpPercent; ?>%;"></div>
                                    <div class="xp-text"><?php echo $xp; ?> / <?php echo $xpMax; ?> XP</div>
                                </div>
                            </div>

                            <div class="lvl"><?= $row['pla_lvl'] ?></div>


                        </div>
                        <h2 class="text dark-red"><?= $row['pla_classe'] ?></h2>

                    </div>
                    
                <?php }
                
            }
        
        ?>

    </div>

</body>
</html>
<script>

    function ver(id){

        window.location.href = "examinar_player.php?id=" + id;

    }

</script>