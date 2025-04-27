<?php
session_start();
include "../mysqlconecta.php";

$ses_id = (int) $_SESSION['ses_id'];

$query = "SELECT COUNT(*) as total FROM players WHERE pla_ses_id = $ses_id";
$result = mysqli_query($conexao, $query);
$row = mysqli_fetch_assoc($result);

$response = [
    "players" => (int) $row['total'],
    "total" => ((int) $_SESSION['play_num']) * 2
];

header('Content-Type: application/json');
echo json_encode($response);
