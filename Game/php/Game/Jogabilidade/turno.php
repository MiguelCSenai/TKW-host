<?php
session_start();
include "../../mysqlconecta.php";

$sessao = $_SESSION['ses_id'] ?? null;
if (!$sessao) header("Location: ../entrar.php");

// Recupera os players da sessão atual
$query = "SELECT pla_id, pla_reino FROM players WHERE pla_ses_id = $sessao ORDER BY pla_id";
$result = mysqli_query($conexao, $query);

$time1 = $time2 = [];
while ($p = mysqli_fetch_assoc($result)) {
    if ($p['pla_reino'] == 1) $time1[] = $p['pla_id'];
    else if ($p['pla_reino'] == 2) $time2[] = $p['pla_id'];
}

// Alterna os jogadores dos dois reinos
$ordem = [];
for ($i = 0; $i < max(count($time1), count($time2)); $i++) {
    if (isset($time1[$i])) $ordem[] = $time1[$i];
    if (isset($time2[$i])) $ordem[] = $time2[$i];
}

$mestreQuery = "SELECT mes_id FROM mestre WHERE ses_id = $sessao";
$mestreResult = mysqli_query($conexao, $mestreQuery);
$mestre = mysqli_fetch_assoc($mestreResult);

if ($mestre) {
    $ordem[] = 'MESTRE';
}


$turnoAtual = $ordem[0];
$ordemSerial = json_encode($ordem);


// Salva ou atualiza os turnos
$check = mysqli_query($conexao, "SELECT 1 FROM turnos WHERE tur_ses_id = $sessao");
if (mysqli_num_rows($check) > 0) {
    mysqli_query($conexao, "UPDATE turnos SET tur_ordem = '$ordemSerial', tur_atual = '$turnoAtual' WHERE tur_ses_id = $sessao");
} else {
    mysqli_query($conexao, "INSERT INTO turnos (tur_ses_id, tur_ordem, tur_atual) VALUES ($sessao, '$ordemSerial', '$turnoAtual')");
}

header("Location: chat.php?dialogo=intro");
?>