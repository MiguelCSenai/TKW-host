<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Cadastro de Player</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 400px;
            margin: auto;
        }

        .hidden {
            display: none;
        }

        button {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container" id="form-container">
        <h1>Cadastro de Player</h1>
        <form id="player-form">
            <label for="nickname">Nickname</label>
            <input type="text" id="nickname" name="nickname" required>

            <button type="submit">Continuar</button>
        </form>
    </div>

    <div class="container hidden" id="next-step">
        <h2>Bem-vindo!</h2>
        <p>O próximo passo será exibido aqui...</p>
        <!-- Você pode colocar outros campos, textos ou botões aqui -->
    </div>

    <script>
        document.getElementById('player-form').addEventListener('submit', function(e) {
            e.preventDefault(); // impede o envio do formulário

            // Esconde o formulário e mostra a próxima etapa
            document.getElementById('form-container').classList.add('hidden');
            document.getElementById('next-step').classList.remove('hidden');
        });
    </script>

</body>
</html>
