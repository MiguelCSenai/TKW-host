<?php
session_start();
include "../../mysqlconecta.php";

if (!isset($_GET['player_id'])) {
    die("ID do jogador não fornecido.");
}

$player_id = intval($_GET['player_id']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $campos = ['pla_HP', 'pla_STR', 'pla_AGI', 'pla_INT', 'pla_Max_HP'];

    // Buscar valores atuais
    $query = "SELECT pla_HP, pla_Max_HP, pla_STR, pla_AGI, pla_INT FROM players WHERE pla_id = $player_id";
    $result = mysqli_query($conexao, $query);
    $player_atual = mysqli_fetch_assoc($result);

    foreach ($campos as $campo) {
        if (!isset($_POST[$campo])) continue;

        $valor = intval($_POST[$campo]);
        if ($valor === 0) continue;

        $atual = $player_atual[$campo];

        // Definir limite máximo por campo
        if ($campo === 'pla_Max_HP') {
            $maximo = 999;
        } elseif ($campo === 'pla_HP') {
            $maximo = $player_atual['pla_Max_HP'];
        } else {
            $maximo = 20;
        }

        $novo_valor = $atual + $valor;

        if ($novo_valor < 0) {
            $novo_valor = 0;
        } elseif ($novo_valor > $maximo) {
            $novo_valor = $maximo;
        }

        $query = "UPDATE players SET $campo = $novo_valor WHERE pla_id = $player_id";
        mysqli_query($conexao, $query);
    }

    header("Location: editar_stats.php?player_id=$player_id");
    exit();
}

$query = "SELECT pla_nome, pla_lvl, pla_HP, pla_Max_HP, pla_STR, pla_AGI, pla_INT FROM players WHERE pla_id = $player_id";
$result = mysqli_query($conexao, $query);
$player = mysqli_fetch_assoc($result);

if (!$player) {
    die("Jogador não encontrado.");
}

$atributos = [
    "pla_Max_HP" => "Max HP",
    "pla_HP" => "HP",
    "pla_STR" => "FOR",
    "pla_AGI" => "AGI",
    "pla_INT" => "INT"
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Stats - <?= $player['pla_nome'] ?></title>
    <link rel="stylesheet" href="../../../css/general/fonts.css">
    <link rel="stylesheet" href="../../../css/game/elements/components.css">
    <link rel="stylesheet" href="../../../css/game/elements/attributes.css">
    <link rel="stylesheet" href="../../../css/game/editar.css">
</head>
<body>

<div class="editar-container">
    <h2>Editar atributos de <span style="color:rgb(255, 0, 0)"><?= $player['pla_nome'] ?></span></h2>
    <form method="POST">

        <?php foreach ($atributos as $campo => $nome): ?>
    <?php
        if ($campo === 'pla_HP') {
            $max = $player['pla_Max_HP'];
        } elseif ($campo === 'pla_Max_HP') {
            $max = 999;
        }elseif($campo === 'pla_STR' || $campo === 'pla_INT'){
            $max = 25;
        } else {
            $max = 20;
        }

        $valor = $player[$campo];
    ?>
    <div class="atributo">
        <strong><?= $nome ?>:</strong>
        <div class="valor-atual"><?= $valor ?><?= $campo !== 'pla_Max_HP' ? " / $max" : "" ?></div>

        <div class="controle">
            <input type="number" name="<?= $campo ?>" min="-99" max="99" value="0">
            <button class="botao" type="submit">Atualizar</button>
        </div>
    </div>
<?php endforeach; ?>


    </form>

        <a class="voltar" href="examinar_player.php?id=<?= $player_id ?>">Voltar</a>
</div>

</body>
</html>
