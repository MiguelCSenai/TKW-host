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

if ($turno_atual !== 'MESTRE'){

    $queryEfeito = "SELECT eft_id, eft_duracao FROM inventario WHERE pla_id = $turno_atual AND eft_id IS NOT NULL";
    $resEfeito = mysqli_query($conexao, $queryEfeito);
    

    while ($efeito = mysqli_fetch_assoc($resEfeito)) {
        
        $updateEfeito = "UPDATE inventario SET eft_duracao = eft_duracao - 1 WHERE pla_id = $turno_atual AND eft_id IS NOT NULL AND eft_duracao > 0";
        $deleteEfeito = "DELETE FROM inventario WHERE pla_id = $turno_atual AND eft_id IS NOT NULL AND eft_duracao <= 0";
        mysqli_query($conexao, $updateEfeito);
        mysqli_query($conexao, $deleteEfeito);

    }



}

header("Location: mestre.php");
exit;
?>
