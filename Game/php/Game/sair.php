<?php

    session_start();

    include "../mysqlconecta.php";

    $ses_id = $_SESSION['ses_id'];

    $query = "UPDATE sessoes SET ses_fim = NOW() WHERE ses_id{$ses_id}";
    mysqli_query($conexao, $query);


    session_unset();
    session_destroy();

    header("Location: ../MainMenu/main.php");

?>