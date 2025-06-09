<?php
session_start();
include "../../mysqlconecta.php";

$sessao = $_SESSION['ses_id'] ?? null;
if (!$sessao) {
    header("Location: ../entrar.php");
    exit;
}

// Obtém a ordem e o turno atual
$query = "SELECT tur_id, tur_ordem, tur_atual FROM turnos WHERE tur_ses_id = $sessao";
$result = mysqli_query($conexao, $query);
$turno = mysqli_fetch_assoc($result);

if (!$turno) {
    header("Location: mestre.php");
    exit;
}

$ordem = json_decode($turno['tur_ordem'], true);
$index = array_search($turno['tur_atual'], $ordem);

$proximo = $ordem[($index + 1) % count($ordem)];

if ($proximo === 'MESTRE') {

    $queryMestre = "SELECT mes_id, mes_lvl, mes_turnos FROM mestre WHERE ses_id = $sessao";
    $resMestre = mysqli_query($conexao, $queryMestre);
    $mestre = mysqli_fetch_assoc($resMestre);

    if ($mestre) {
        $mes_id = $mestre['mes_id'];
        $mes_lvl = $mestre['mes_lvl'];
        $mes_turnos = $mestre['mes_turnos'];

        if ($mes_turnos >= 4) {
            $queryUp = "UPDATE mestre SET mes_lvl = mes_lvl + 1, mes_turnos = 0, mes_creditos = mes_creditos + (mes_lvl * 5 + 5) WHERE mes_id = $mes_id";
        } else {
            $queryUp = "UPDATE mestre SET mes_turnos = mes_turnos + 1, mes_creditos = mes_creditos + 5 WHERE mes_id = $mes_id";
        }

        mysqli_query($conexao, $queryUp);
    }
}else{

    $queryEfeito = "SELECT eft_id, eft_duracao FROM inventario WHERE pla_id = $proximo AND eft_id IS NOT NULL";
    $resEfeito = mysqli_query($conexao, $queryEfeito);
    

    while ($efeito = mysqli_fetch_assoc($resEfeito)) {
        
        $updateEfeito = "UPDATE inventario SET eft_duracao = eft_duracao - 1 WHERE pla_id = $proximo AND eft_id IS NOT NULL AND eft_duracao > 0";
        $deleteEfeito = "DELETE FROM inventario WHERE pla_id = $proximo AND eft_id IS NOT NULL AND eft_duracao <= 0";
        mysqli_query($conexao, $updateEfeito);
        mysqli_query($conexao, $deleteEfeito);

    }



}



mysqli_query($conexao, "UPDATE turnos 
                        SET tur_atual = '$proximo' 
                        WHERE tur_ses_id = $sessao");

header("Location: mestre.php");
exit;
?>
