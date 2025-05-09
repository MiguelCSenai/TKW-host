<?php
session_start();
include "../../mysqlconecta.php";

$player_id = $_SESSION['player_id'];

if (isset($_POST['bloco'], $_POST['x'], $_POST['y'])) {
    $bloco = (int)$_POST['bloco'];
    $x = (int)$_POST['x'];
    $y = (int)$_POST['y'];

    $update = "UPDATE players SET pla_bloco = $bloco, pla_x = $x, pla_y = $y WHERE pla_id = $player_id";
    if (mysqli_query($conexao, $update)) {
        echo "ok";
    } else {
        echo "erro";
    }
} else {
    echo "dados_invalidos";
}

mysqli_close($conexao);
?>
