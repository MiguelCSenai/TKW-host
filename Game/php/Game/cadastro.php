<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Cadastro de Player</title>
    <link rel="stylesheet" href="../../css/game/cadastroMobile.css">
    <link rel="stylesheet" href="../../css/general/fonts.css">
    <link rel="stylesheet" href="../../css/general/elements.css">
    <link rel="stylesheet" href="../../css/general/attributes.css">
</head>
<body>

    <div class="container" id="form-nome">
        <h1 class="red bold titleV SdarkRed">Ficha de prisioneiro</h1>
        <form id="player-form">
            <div class="input-group">

                <label class="textV bigT" for="nickname">Nome:</label>
                <input class="titleV" type="text" id="nickname" name="nickname" required>

            </div>

            <button type="submit">Continuar</button>
        </form>
    </div>

    <div class="container hidden" id="form-classe">
        <form id="player-form">
            <div class="input-group">
                <label class="textV bigT" for="classe">Classe do criminoso:</label>
            </div>

            <div class="slider-container">
                <button type="button" id="prev-btn">◀</button>
                
                <div class="slider-content">
                    <img id="classe-img" src="img/ladrao.png" alt="Classe" />
                    <div id="classe-display">Ladrão</div>
                </div>

                <button type="button" id="next-btn">▶</button>
            </div>

            <!-- Campo oculto que envia o valor da classe -->
            <input type="hidden" id="classe" name="classe" value="Ladrão">

            <button type="submit">Continuar</button>
        </form>
    </div>



    <div class="container hidden" id="form-time">
        <form id="player-form">
            <div class="input-group">

                <label class="textV bigT" for="nickname">Nome:</label>
                <input type="text" id="nickname" name="nickname" required>

            </div>

            <button type="submit">Continuar</button>
        </form>
    </div>

    <script>
        document.getElementById('player-form').addEventListener('submit', function(e) {
            e.preventDefault();

            document.getElementById('form-nome').classList.add('hidden');
            document.getElementById('form-classe').classList.remove('hidden');
        });
        const classes = [
            { nome: "Ladrão", imagem: "img/ladrao.png" },
            { nome: "Assassino", imagem: "img/assassino.png" },
            { nome: "Hacker", imagem: "img/hacker.png" },
            { nome: "Mercenário", imagem: "img/mercenario.png" }
        ];

        let currentIndex = 0;

        const display = document.getElementById("classe-display");
        const img = document.getElementById("classe-img");
        const hiddenInput = document.getElementById("classe");

        function updateClasse() {
            const current = classes[currentIndex];
            display.textContent = current.nome;
            img.src = current.imagem;
            hiddenInput.value = current.nome;
        }

        document.getElementById("prev-btn").addEventListener("click", () => {
            currentIndex = (currentIndex - 1 + classes.length) % classes.length;
            updateClasse();
        });

        document.getElementById("next-btn").addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % classes.length;
            updateClasse();
        });
        updateClasse();
</script>


        
    </script>

</body>
</html>
