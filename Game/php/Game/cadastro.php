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
        <form>
            <div class="input-group">

                <label class="textV bigT" for="nickname">Nome:</label>
                <input class="titleV" type="text" id="nickname" name="nickname" required>

            </div>

            <button type="submit">Continuar</button>
        </form>
    </div>

    <div class="container hidden" id="form-classe">
        <form class="classe">
            <div class="input-group">
                <label class="textV bigT" for="classe">Classe do criminoso:</label>
            </div>

            <div class="slider-container">
                <button type="button" id="prev-btn">◀</button>
                
                <div class="slider-content">
                    <img id="classe-img" alt="Classe" />
                    <div id="classe-display">Ladrão</div>
                </div>

                <button type="button" id="next-btn">▶</button>
            </div>

            <input type="hidden" id="classe" name="classe" value="Ladrão">

            <button type="submit">Continuar</button>
        </form>
    </div>



    <div class="container hidden" id="form-time">
        <form class="reino">
            
            <label class="textV bigT bold" for="reino">Reino de origem:</label>
            <div class="input-group">

                <input type="button" onclick="salvar(1)" value="Reino 1">
                <input type="button" onclick="salvar(2)" value="Reino 2">


            </div>
        </form>
    </div>
    <div class="container hidden" id="form-enviar">
        <form action="enviarJogador.php" method="post">

            <input type="hidden" id="nickP" name="nickP">
            <input type="hidden" id="classeP" name="classeP">
            <input type="hidden" id="reinoP" name="reinoP">

            <button class="btn2">Convocar Prisioneiro</button>
            
        </form>
    </div>

    <script src="../../js/game/cadastro.js"></script>

</body>
</html>
