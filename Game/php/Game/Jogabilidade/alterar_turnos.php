<?php
session_start();
include "../../mysqlconecta.php";

$sessao = $_SESSION['ses_id'] ?? null;
if (!$sessao) header("Location: ../entrar.php");

$query = "SELECT tur_ordem, tur_atual FROM turnos WHERE tur_ses_id = $sessao";
$result = mysqli_query($conexao, $query);
$turnos = mysqli_fetch_assoc($result);

$ordem = json_decode($turnos['tur_ordem'], true);
$atual = $turnos['tur_atual'];

$query_players = "SELECT pla_id, pla_nome FROM players WHERE pla_ses_id = $sessao";
$result_players = mysqli_query($conexao, $query_players);
$nomes_players = [];
while ($p = mysqli_fetch_assoc($result_players)) {
    $nomes_players[$p['pla_id']] = $p['pla_nome'];
}

function nomeTurno($id) {
    global $nomes_players;
    
    if (strpos($id, 'M') === 0 || $id === 'MESTRE') return 'Mestre';
    
    return $nomes_players[$id] ?? "Player $id";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Turnos</title>
    <link rel="stylesheet" href="../../../css/general/fonts.css">
    <link rel="stylesheet" href="../../../css/game/elements/components.css">
    <link rel="stylesheet" href="../../../css/game/elements/animations.css">
    <link rel="stylesheet" href="../../../css/game/elements/attributes.css">
    <link rel="stylesheet" href="../../../css/game/alterar.css">
</head>
<body>
    <p class="subtitle bigT red SdarkRed bold">Editar Ordem dos Turnos</p>

<form method="post" action="salvar_turnos.php">
    <ul id="ordem">
        <?php foreach ($ordem as $id): ?>
            <li data-id="<?= $id ?>" class="text bold red<?= $id == $atual ? ' atual' : '' ?>">
                <?= nomeTurno($id) ?>
                <input type="radio" name="atual" value="<?= $id ?>" <?= $id == $atual ? 'checked' : '' ?>>
            </li>
        <?php endforeach; ?>
    </ul>

    <input type="hidden" name="nova_ordem" id="nova_ordem">
    <button class="subtitle white bold mediumT" type="submit">Salvar Alterações</button>
</form>


<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    const ul = document.getElementById('ordem');

    Sortable.create(ul, {
        animation: 150,
        ghostClass: 'ghost',
        onStart: function (evt) {
            const dummy = document.createElement('div');
            dummy.style.display = 'none';
            document.body.appendChild(dummy);
            evt.originalEvent.dataTransfer.setDragImage(dummy, 0, 0);
        }
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        const ids = Array.from(ul.children).map(li => li.dataset.id);
        document.getElementById('nova_ordem').value = JSON.stringify(ids);
    });
</script>


<style>
    li.ghost {
        opacity: 1;
    }
</style>

</body>
</html>
<a href="mestre.php" class="sair subtitle">VOLTAR</a>
