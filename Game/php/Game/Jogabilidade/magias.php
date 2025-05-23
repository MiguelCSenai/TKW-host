<?php
session_start();
include "../../mysqlconecta.php";

$player_id = $_SESSION['player_id'];

$query_magias = "SELECT m.mag_id, m.mag_nome, m.mag_descricao, m.mag_conjuracao, m.mag_icone
                 FROM magias m
                 JOIN inventario inv ON m.mag_id = inv.mag_id
                 WHERE inv.pla_id = {$player_id}";

$result = mysqli_query($conexao, $query_magias);

$magias = [];

while ($row = mysqli_fetch_assoc($result)) {
    $magias[] = $row;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ficha de Personagem - Magias</title>
    <link rel="stylesheet" href="../../../css/game/inventario.css" />
    <link rel="stylesheet" href="../../../css/general/fonts.css" />
    <link rel="stylesheet" href="../../../css/general/attributes.css" />
    <style>
        
    </style>
</head>
<body style="padding: 0;">

    <?php if(empty($magias)): ?>
        <p class="subtitle" style="margin:20px;">Nenhuma magia no inventário.</p>
    <?php endif; ?>

    <?php foreach ($magias as $magia): ?>
        <div class="magia solid mediumBS text">
            <div class="icon">
                <?php if(!empty($magia['mag_icone'])): ?>
                    <img src="<?= $magia['mag_icone'] ?>" alt="<?= $magia['mag_nome'] ?>" />
                <?php else: ?>
                    <img src="../../../resources/default_magic_icon.png" alt="Ícone padrão" />
                <?php endif; ?>
                <h2 class="textV" style="font-size: 3em; margin-block: 0"><?= $magia['mag_nome'] ?></h2>
            </div>
            <div class="content">
                <p style="text-align: center; width: 100%; font-size: 1.5em;"><strong class="subtitle">Descrição:</strong></p>
                <p class="descricao-mag" style="text-align:center; margin-bottom: 3vh;"><?= $magia['mag_descricao'] ?></p>

                <p><strong class="subtitle">Tempo de conjuração:</strong> <?= $magia['mag_conjuracao'] ?> Turnos</p>
            </div>
        </div>
    <?php endforeach; ?>

    <a href="playerIndex.php" class="voltar subtitle">Voltar</a>

</body>
</html>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const limiteCaracteres = 60;

    document.querySelectorAll(".descricao-mag").forEach(paragrafo => {
        const textoOriginal = paragrafo.innerHTML;

        if (textoOriginal.length > limiteCaracteres) {
            const textoCortado = textoOriginal.slice(0, limiteCaracteres);
            const restante = textoOriginal.slice(limiteCaracteres);

            const spanResumo = document.createElement("span");
            spanResumo.innerHTML = textoCortado + "... ";

            const spanRestante = document.createElement("span");
            spanRestante.innerHTML = restante;
            spanRestante.style.display = "none";

            const botaoVerMais = document.createElement("button");
            botaoVerMais.textContent = "Ver mais";
            botaoVerMais.style.marginLeft = "5px";
            botaoVerMais.style.cursor = "pointer";
            botaoVerMais.className = "subtitle";

            botaoVerMais.addEventListener("click", function () {
                if (spanRestante.style.display === "none") {
                    spanRestante.style.display = "inline";
                    botaoVerMais.textContent = "Ver menos";
                } else {
                    spanRestante.style.display = "none";
                    botaoVerMais.textContent = "Ver mais";
                }
            });

            // Limpa o conteúdo e reconstrói com "Ver mais"
            paragrafo.innerHTML = "";
            paragrafo.appendChild(spanResumo);
            paragrafo.appendChild(spanRestante);
            paragrafo.appendChild(botaoVerMais);
        }
    });
});
</script>