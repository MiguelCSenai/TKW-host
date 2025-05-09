<?php
session_start();
include "../../mysqlconecta.php";

$player_id = $_SESSION['player_id'];

if (isset($_POST['bloco'], $_POST['x'], $_POST['y'])) {
    $bloco = (int)$_POST['bloco'];
    $x = (int)$_POST['x'];
    $y = (int)$_POST['y'];

    $query_update = "UPDATE players SET pla_bloco = $bloco, pla_x = $x, pla_y = $y WHERE pla_id = $player_id";
    if (mysqli_query($conexao, $query_update)) {

        $query_sessao = "SELECT pla_ses_id FROM players WHERE pla_id = $player_id";
        $res_sessao = mysqli_query($conexao, $query_sessao);
        $sessao = mysqli_fetch_assoc($res_sessao)['pla_ses_id'];

        $res_turno = mysqli_query($conexao, "SELECT tur_ordem, tur_atual FROM turnos WHERE tur_ses_id = $sessao");
        if ($res_turno && mysqli_num_rows($res_turno) > 0) {
            $turno = mysqli_fetch_assoc($res_turno);
            $ordem = json_decode($turno['tur_ordem']);
            $atual = $turno['tur_atual'];

            $idx = array_search($atual, $ordem);
            if ($idx !== false) {
                $prox_idx = ($idx + 1) % count($ordem);
                $prox_turno = $ordem[$prox_idx];

                mysqli_query($conexao, "UPDATE turnos SET tur_atual = $prox_turno WHERE tur_ses_id = $sessao");
            }
        }

        echo "ok";
    } else {
        echo "erro_movimento";
    }
} else {
    echo "dados_invalidos";
}

mysqli_close($conexao);
