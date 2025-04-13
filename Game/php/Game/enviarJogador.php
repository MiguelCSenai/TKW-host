<?php

    include "../mysqlconecta.php";

    $nome = $_POST['nickP'];
    $classe = $_POST['classeP'];
    $reino = $_POST['reinoP'];

    $query = "INSERT INTO players (pla_nome, pla_classe, pla_reino) 
              VALUES ('$nome', '$classe', '$reino')";

    if (mysqli_query($conexao, $query)) {

        session_start();

        $_SESSION['nome'] = $nome;
        $_SESSION['classe'] = $classe;
        $_SESSION['reino'] = $reino;
        header("Location: ./Jogabilidade/playerIndex.php");
        exit();
    } else {
        echo "<p>Erro ao cadastrar jogador: " . mysqli_error($conexao) . "</p>";
    }

?>