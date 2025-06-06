<?php
include "../../mysqlconecta.php";

    $player = $_GET['player'];
    $efeito = $_GET['efeito'];

    $query = "DELETE FROM inventario WHERE pla_id = $player AND eft_id = $efeito";
    if (mysqli_query($conexao, $query)) {
        
        header("Location: examinar_player.php?id=$player");

    }else {
        echo mysqli_error($conexao, $query);
    }



?>