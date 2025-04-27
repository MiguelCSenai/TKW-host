<?php
session_start();
include "../mysqlconecta.php";

$ses_id = (int) $_SESSION['ses_id'];

$query = "SELECT pla_nome, pla_classe, pla_reino FROM players WHERE pla_ses_id = $ses_id ORDER BY pla_reino, pla_nome";
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

echo json_encode([
    'reino1' => $reino1,
    'reino2' => $reino2
]);
?>