<?php session_start();

include "../mysqlconecta.php";

$play_num = isset($_GET["player"]) ? (int)$_GET["player"] : header("Location: players.php");



$_SESSION['play_num'] = $play_num;

if (!isset($_SESSION['ses_id'])) {

    $play_num = (int) $_SESSION['play_num'];

    mysqli_query($conexao, "INSERT INTO sessoes (ses_limite) VALUES ($play_num);");
    $ses_id = mysqli_insert_id($conexao);

    $_SESSION['ses_id'] = $ses_id;

}else{

    $ses_id = $_SESSION['ses_id'];

}
?>

<!DOCTYPE html>
<html lang="en">
<audio id="background" loop>
    <source src="../../resources/sfx/players.mp3" type="audio/mpeg">
</audio>
<head>=
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

    if(isset($_SESSION['ses_id'])){
        
        $query = "SELECT pla_nome, pla_classe, pla_reino FROM players WHERE pla_ses_id = $ses_id ORDER BY pla_reino, pla_nome";

    }else{

        $query = "SELECT pla_nome, pla_classe, pla_reino FROM players ORDER BY pla_reino, pla_nome";
    
    }
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
                echo "<div class='mini-container text'><span class='bold'>{$player['pla_nome']}</span> | {$player['pla_classe']}</div>";
            } else {
                echo "<div class='mini-container text'>Jogador " . ($i + 1) . "</div>";
            }
        }
        ?>
    </div>

    <div class="containerQr">
        <a href="sair.php" class="btn1 dark-redBC redB white text bold mediumT">Sair</a>
        <p class="subtile bigT bold">Sessão #<?php echo $ses_id; ?></p>
        <img class="qr" src="qr.php" alt="QR Code">
        <?php
        
            $query_contagem = "SELECT COUNT(*) AS total FROM players WHERE pla_ses_id = $ses_id";
            $result_contagem = mysqli_query($conexao, $query_contagem);
            $contagem_players = mysqli_fetch_assoc($result_contagem);
            $players = $contagem_players['total'];

            if ($players == ($play_num * 2)) {
                echo "<a href='Jogabilidade/chat.php?dialogo=intro' class='btn2 redB dark-redBC white bold mediumT title'>Iniciar Sessão</a>";
            }else{

                echo "<h2 class='subtitle'>Quando todos os jogadores estiverem cadastrados aperte F5</h2>";

            }
        
        ?>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const audio = document.getElementById("background");

    audio.play().catch(() => {
        document.addEventListener('click', () => {
            audio.play();
        }, { once: true });
    });
});
</script>