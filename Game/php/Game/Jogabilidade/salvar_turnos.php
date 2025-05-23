<?php
session_start();
include "../../mysqlconecta.php";

$sessao = $_SESSION['ses_id'] ?? null;
if (!$sessao || !isset($_POST['nova_ordem'], $_POST['atual'])) {
    header("Location: alterar_turnos.php");
    exit;
}

$nova_ordem = mysqli_real_escape_string($conexao, $_POST['nova_ordem']);
$turno_atual = mysqli_real_escape_string($conexao, $_POST['atual']);

$query = "UPDATE turnos SET tur_ordem = '$nova_ordem', tur_atual = '$turno_atual' WHERE tur_ses_id = $sessao";
mysqli_query($conexao, $query);

header("Location: alterar_turnos.php");
exit;
?>
