<?php session_start();

include "../../mysqlconecta.php";

    $player_id = $_SESSION['player_id'];

    $query_items = "SELECT i.itm_id, i.itm_nome, i.itm_tipo, i.itm_efeito, i.itm_img, COUNT(*) as quantidade
                    FROM items i
                    JOIN inventario inv ON i.itm_id = inv.itm_id
                    WHERE inv.pla_id = {$player_id}
                    GROUP BY i.itm_id, i.itm_nome, i.itm_tipo, i.itm_efeito, i.itm_img";

    $result = mysqli_query($conexao, $query_items);

    $items = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Ficha de Personagem</title>
    <link rel="stylesheet" href="../../../css/game/inventario.css">
    <link rel="stylesheet" href="../../../css/general/fonts.css">
    <link rel="stylesheet" href="../../../css/general/attributes.css">
</head>
<body>

    <h1 class="inv subtitle red SdarkRed">Inventário</h1>
    <div class="inventory">
        <?php foreach ($items as $item): ?>
            <div class="item-card">
                <?php if (!empty($item['itm_img'])): ?>
                    <img src="<?= $item['itm_img'] ?>" alt="<?= $item['itm_nome'] ?>" class="item-img">
                <?php endif; ?>
                <h3 class="text white bold"><?= $item['itm_nome'] ?></h3>
                <p class="quantidade text white">x<?= $item['quantidade'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>


</body>
</html>