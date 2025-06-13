<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drop de Items </title>
    <link rel="stylesheet" href="../../../css/game/bau.css">
    <link rel="stylesheet" href="../../../css/general/fonts.css">
</head>
<body>

    <div class="bau">
        <button onclick="gerar()" class="subtitle mediumT hobbit">Gerar loot</button>
        <div id="resultado" class="resultado subtitle"></div>
    </div>


    <a href="mestre.php" class="sair subtitle">VOLTAR</a>

</body>
</html>

<script>
function gerar() {
    const urlParams = new URLSearchParams(window.location.search);
    const playerId = urlParams.get('id');

    fetch('gerar_loot.php?id=' + playerId)
        .then(res => res.json())
        .then(data => {
            const div = document.getElementById('resultado');
            if (data.erro) {
                div.innerHTML = `<p class="erro">${data.erro}</p>`;
                return;
            }

            let html = `<p>Raridade sorteada: <strong>${data.raridade}</strong></p>`;
            html += `<p>Quantidade total de recompensas: <strong>${data.quantidade}</strong></p>`;

            if (data.armas.length) {
                html += `<p>Arma: ${data.armas.map(nome => `<span>${nome}</span>`).join(', ')}</p>`;
            }

            if (data.items.length) {
                html += `<p>Itens: ${data.items.map(nome => `<span>${nome}</span>`).join(', ')}</p>`;
            }

            if (data.magias.length) {
                html += `<p>Magias: ${data.magias.map(nome => `<span>${nome}</span>`).join(', ')}</p>`;
            }

            div.innerHTML = html;
        })
        .catch(err => {
            document.getElementById('resultado').innerHTML = "Erro ao gerar loot.";
            console.error(err);
        });
}

</script>