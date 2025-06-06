<?php
include "../../php/mysqlconecta.php";

    $query = "SELECT cla_nome FROM classes";
    $result = $conexao->query($query);

    $classes = [];

    while ($row = $result->fetch_assoc()) {
        $classes[] = ["nome" => $row['cla_nome']];
    }

    echo json_encode($classes);

    $conexao->close();

?>