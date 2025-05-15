<?php
session_start();
include "../../mysqlconecta.php";

$sessao_id = $_SESSION['ses_id'];

$check = mysqli_query($conexao, "SELECT COUNT(*) as total FROM monstros_sessao WHERE ses_id = $sessao_id");
$dado = mysqli_fetch_assoc($check);

if ($dado['total'] == 0) {

    $monstros_base = mysqli_query($conexao, "SELECT mon_id FROM monstros");
    $monstros = [];

    while ($m = mysqli_fetch_assoc($monstros_base)) {
        $monstros[] = $m['mon_id'];
    }

$quantidade = 50;

    for ($i = 0; $i < $quantidade; $i++) {
        $mon_id = $monstros[array_rand($monstros)];
        $bloco = rand(1, 9);
        $x = rand(1, 20);
        $y = rand(1, 20);

        mysqli_query($conexao, "INSERT INTO monstros_sessao (ses_id, mon_id, ms_bloco, ms_x, ms_y)
                                VALUES ($sessao_id, $mon_id, $bloco, $x, $y)");
    }

    echo "Monstros gerados com sucesso!";
} else {
    echo "Monstros já foram gerados para essa sessão.";
}

mysqli_close($conexao);
