<?php
session_start();
include "../../mysqlconecta.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pla_id = intval($_POST['pla_id']);
    $eft_id = intval($_POST['eft_id']);
    $eft_duracao = $_POST['turnos'];

    // Evita duplicações
    $verifica = "SELECT * FROM inventario WHERE pla_id = $pla_id AND eft_id = $eft_id";
    $res = mysqli_query($conexao, $verifica);

    if (mysqli_num_rows($res) > 0) {
        echo "Efeito já adicionado.";
        exit;
    }

    if (!empty($eft_duracao) && $eft_duracao > 0) {

        $duracao = $eft_duracao;

    }else{

        $sql_efeito = "SELECT eft_duracao FROM efeitos WHERE eft_id = $eft_id";
        $res_efeito = mysqli_query($conexao, $sql_efeito);
        $efeito = mysqli_fetch_assoc($res_efeito);
        $duracao = intval($efeito['eft_duracao']);

    }
    
    if ($duracao) {

        $query = "INSERT INTO inventario (pla_id, eft_id, eft_duracao) VALUES ($pla_id, $eft_id, $duracao)";
        if (mysqli_query($conexao, $query)) {
            echo "ok";
        } else {
            echo "Erro ao inserir: " . mysqli_error($conexao);
        }
    } else {
        echo "Efeito não encontrado.";
    }
}
?>
