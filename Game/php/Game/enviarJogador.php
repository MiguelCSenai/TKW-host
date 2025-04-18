<?php
session_start();
include "../mysqlconecta.php";

$atributos = [
    'Guerreiro' => ['HP' => 40, 'STR' => 9, 'AGI' => 11, 'INT' => 6],
    'Mago' => ['HP' => 20, 'STR' => 5, 'AGI' => 8, 'INT' => 12],
    'Armadilheiro' => ['HP' => 15, 'STR' => 3, 'AGI' => 14, 'INT' => 11],
    'Arqueiro' => ['HP' => 30, 'STR' => 7, 'AGI' => 13, 'INT' => 9],
];

$classe = $_POST['classeP'];
$nome = $_POST['nickP'];
$reino = $_POST['reinoP'];

$ses_id = $_SESSION['ses_id'];
$stats = $atributos[$classe];

$query_limite = "SELECT ses_limite FROM sessoes WHERE ses_id = $ses_id";
$result_limite = mysqli_query($conexao, $query_limite);
$row_limite = mysqli_fetch_assoc($result_limite);
$limite = $row_limite['ses_limite'];

$query_contagem = "SELECT COUNT(*) AS total FROM players WHERE pla_ses_id = $ses_id AND pla_reino = $reino";
$result_contagem = mysqli_query($conexao, $query_contagem);
$row_contagem = mysqli_fetch_assoc($result_contagem);
$limite_time = $row_contagem['total'];

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Equipe Cheia</title>
    <link rel="stylesheet" href="../../css/game/cadastroMobile.css">
    <link rel="stylesheet" href="../../css/general/fonts.css">
    <link rel="stylesheet" href="../../css/general/elements.css">
    <link rel="stylesheet" href="../../css/general/attributes.css">
</head>

<body>
    

<?php

if ($limite_time >= $limite) {
    echo "<p class='subtitle bold mediumT' style='text-align: center; color:red;'>O time {$reino} já está cheio! (máximo de {$limite} jogadores)</p>";
    exit();
}

?>


</body>

</html>

<?php

$query = "INSERT INTO players (pla_nome, pla_classe, pla_reino, pla_HP, pla_STR, pla_AGI, pla_INT, pla_ses_id)
          VALUES ('$nome', '$classe', '$reino', {$stats['HP']}, {$stats['STR']}, {$stats['AGI']}, {$stats['INT']}, '$ses_id')";

if (mysqli_query($conexao, $query)) {
    $_SESSION['nome'] = $nome;
    $_SESSION['classe'] = $classe;
    $_SESSION['reino'] = $reino;
    $_SESSION['max_hp'] = $stats['HP'];
    header("Location: ./Jogabilidade/playerIndex.php");
    exit();
} else {
    echo "<p class='title bold bigT'>Erro ao cadastrar jogador: " . mysqli_error($conexao) . "</p>";
}

?>