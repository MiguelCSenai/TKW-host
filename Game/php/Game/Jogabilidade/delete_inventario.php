<?php
session_start();
include "../../mysqlconecta.php";

$player_id = $_POST['pla_id'] ?? null;
$quanto = $_POST['quanto'] ?? '';
$tipo = $_POST['tipo'] ?? '';
$id = (int) $_POST['id'];

if (!$player_id || !$id || !$tipo) {
    http_response_code(400);
    echo "Dados inválidos.";
    exit;
}

switch ($tipo) {
    case 'item':
        $coluna = 'itm_id';
        break;
    case 'arma':
        $coluna = 'wpn_id';
        break;
    case 'magia':
        $coluna = 'mag_id';
        break;
    default:
        http_response_code(400);
        echo "Tipo inválido.";
        exit;
}

switch ($quanto) {
    case 'um':
        $query_delete = "DELETE FROM inventario WHERE pla_id = $player_id AND $coluna = $id LIMIT 1";
        break;
    case 'todos':
        $query_delete = "DELETE FROM inventario WHERE pla_id = $player_id AND $coluna = $id";
        break;
    default:
        http_response_code(400);
        echo "Quantidade inválida.";
        exit;
}

if (mysqli_query($conexao, $query_delete)) {
    echo "ok";
} else {
    http_response_code(500);
    echo "Erro ao deletar.";
}
?>
