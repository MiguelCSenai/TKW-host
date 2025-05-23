<?php
session_start();
include "../../mysqlconecta.php";

$player_id = $_SESSION['player_id'] ?? null;

if (!$player_id) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'sem_id']);
    exit;
}

$query = "SELECT pla_ses_id FROM players WHERE pla_id = $player_id";
$result = mysqli_query($conexao, $query);
$player = mysqli_fetch_assoc($result);

if (!$player) {
    echo json_encode(['status' => 'erro', 'mensagem' => 'player_nao_encontrado']);
    exit;
}

$query_turno = "SELECT tur_atual FROM turnos WHERE tur_ses_id = {$player['pla_ses_id']}";
$result_turno = mysqli_query($conexao, $query_turno);
$turno = mysqli_fetch_assoc($result_turno);

$eh_turno = $turno && $turno['tur_atual'] == $player_id;

// Caso queira também sinalizar quando for o turno do mestre, você pode retornar a string:
echo json_encode([
    'status' => 'ok',
    'eh_turno' => $eh_turno,
    'turno_atual' => $turno['tur_atual']
]);
