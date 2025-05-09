<?php
session_start();
include "../../mysqlconecta.php";

$sessao = $_SESSION['ses_id'];

$players = [];
$query = "SELECT pla_nome, pla_x, pla_y, pla_bloco, pla_reino FROM players WHERE pla_ses_id = $sessao";
$result = mysqli_query($conexao, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $players[] = $row;
    }
}

mysqli_close($conexao);

header('Content-Type: application/json');
echo json_encode($players);
?>
