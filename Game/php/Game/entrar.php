<?php 
session_start();
include "../mysqlconecta.php";

if (!isset($_GET["player"]) && (!isset($_SESSION['play_num']) || !isset($_SESSION['ses_id']))) {
    header("Location: players.php");
    exit;
}

if (isset($_GET["player"]) && !isset($_SESSION['ses_id'])) {
    $play_num = (int) $_GET["player"];
    $_SESSION['play_num'] = $play_num;

    mysqli_query($conexao, "INSERT INTO sessoes (ses_limite) VALUES ($play_num);");
    $ses_id = mysqli_insert_id($conexao);
    $_SESSION['ses_id'] = $ses_id;
} else {
    $play_num = (int) $_SESSION['play_num'];
    $ses_id = (int) $_SESSION['ses_id'];
}

$query = "SELECT pla_nome, pla_classe, pla_reino 
          FROM players 
          WHERE pla_ses_id = $ses_id 
          ORDER BY pla_reino, pla_nome";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="../../css/game/players.css">
    <link rel="stylesheet" href="../../css/general/fonts.css">
    <link rel="stylesheet" href="../../css/general/elements.css">
    <link rel="stylesheet" href="../../css/general/attributes.css">
</head>
<body>
<audio id="background" loop>
    <source src="../../resources/sfx/players.mp3" type="audio/mpeg">
</audio>

<div class="main-container">

    <div class="container">
        <h1 class="subtitle">Reino 1</h1>
        <div id="reino1">
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
    </div>

    <div class="containerQr">
        <a href="sair.php" class="btn1 dark-redBC redB white text bold mediumT">Sair</a>
        <p class="subtitle bigT bold">Sessão #<?php echo $ses_id; ?></p>
        <img class="qr" src="qr.php" alt="QR Code">
        <div id="status">
            <h2 class="subtitle">0/<?php echo ($play_num * 2); ?> Jogadores Cadastrados</h2>
        </div>
    </div>

    <div class="container">
        <h1 class="subtitle">Reino 2</h1>
        <div id="reino2">
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

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const audio = document.getElementById("background");
    audio.play().catch(() => {
        document.addEventListener('click', () => {
            audio.play();
        }, { once: true });
    });//tocar musiquinha:)

    function atualizarContagem() {
        fetch('contagem.php')
            .then(response => response.json())
            .then(data => {
                const statusDiv = document.getElementById('status');
                if (data.players < data.total) {
                    statusDiv.innerHTML = `<h2 class="subtitle">${data.players}/${data.total} Jogadores Cadastrados</h2>`;
                } else {
                    statusDiv.innerHTML = `<a href='Jogabilidade/turno.php' class='btn2 redB dark-redBC white bold mediumT title'>Iniciar Sessão</a>`;
                }
            });
    }

    function atualizarJogadores() {
        fetch('players.php')
            .then(response => response.json())
            .then(data => {
                const reino1 = document.getElementById('reino1');
                const reino2 = document.getElementById('reino2');

                let htmlReino1 = '';
                let htmlReino2 = '';

                const totalJogadores = <?php echo $play_num; ?>;

                for (let i = 0; i < totalJogadores; i++) {                                           
                    if (data.reino1[i]) {
                        htmlReino1 += `<div class="mini-container text"><span class="bold">${data.reino1[i].pla_nome}</span> | ${data.reino1[i].pla_classe}</div>`;
                    } else {
                        htmlReino1 += `<div class="mini-container text">Jogador ${i + 1}</div>`;
                    }                                                                           
                }

                for (let i = 0; i < totalJogadores; i++) {
                    if (data.reino2[i]) {
                        htmlReino2 += `<div class="mini-container text"><span class="bold">${data.reino2[i].pla_nome}</span> | ${data.reino2[i].pla_classe}</div>`;
                    } else {
                        htmlReino2 += `<div class="mini-container text">Jogador ${i + 1 + totalJogadores}</div>`;
                    }
                }

                
                reino1.innerHTML = htmlReino1;
                reino2.innerHTML = htmlReino2;
            });
    }

    setInterval(() => {
        atualizarContagem();
        atualizarJogadores();
    }, 2000);
});
</script>
</body>
</html>
    