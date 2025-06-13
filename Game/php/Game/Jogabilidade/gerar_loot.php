<?php
include "../../mysqlconecta.php";
header('Content-Type: application/json');

$player = $_GET['id'] ?? 0;
if (!$player) {
    echo json_encode(['erro' => 'ID de jogador inválido']);
    exit;
}

// Buscar classe do jogador
$queryClasse = "SELECT pla_classe FROM players WHERE pla_id = $player";
$resultClasse = mysqli_query($conexao, $queryClasse);
$classe = mysqli_fetch_assoc($resultClasse)['pla_classe'] ?? '';

function sortear($array) {
    return $array[array_rand($array)];
}

$pesos = [1, 1, 1, 1, 1, 2, 2, 2, 2, 3, 3, 3, 4, 4, 5];
$quantidades = [1, 1, 1, 1, 1, 2, 2, 2, 2, 3, 3, 3, 4, 4, 5, 6];

$raridade = sortear($pesos);
$totalRecompensas = sortear($quantidades);

$loot = [
    'raridade' => $raridade,
    'quantidade' => $totalRecompensas,
    'armas' => [],
    'items' => [],
    'magias' => []
];

$armaJaVeio = false;

for ($i = 0; $i < $totalRecompensas; $i++) {
    $possibilidades = ['item'];

    if (!$armaJaVeio) {
        $possibilidades[] = 'arma';
    }

    if (strtolower($classe) === 'mago') {
        $possibilidades[] = 'magia';
    }

    $categoria = sortear($possibilidades);

    if ($categoria === 'arma') {
        $query = "SELECT wpn_id, wpn_nome FROM armas WHERE wpn_raridade = $raridade ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($conexao, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            mysqli_query($conexao, "INSERT INTO inventario (pla_id, wpn_id) VALUES ($player, {$row['wpn_id']})");
            $loot['armas'][] = $row['wpn_nome'];
            $armaJaVeio = true;
        }
    } elseif ($categoria === 'item') {
        $query = "SELECT itm_id, itm_nome FROM items ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($conexao, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            mysqli_query($conexao, "INSERT INTO inventario (pla_id, itm_id) VALUES ($player, {$row['itm_id']})");
            $loot['items'][] = $row['itm_nome'];
        }
    } elseif ($categoria === 'magia') {
        $query = "SELECT mag_id, mag_nome FROM magias ORDER BY RAND() LIMIT 1";
        $result = mysqli_query($conexao, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            mysqli_query($conexao, "INSERT INTO inventario (pla_id, mag_id) VALUES ($player, {$row['mag_id']})");
            $loot['magias'][] = $row['mag_nome'];
        }
    }
}

echo json_encode($loot);
