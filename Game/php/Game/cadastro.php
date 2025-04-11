<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Cadastro de Player</title>
</head>
<body>

    <div class="container">
        <h1>Cadastro de Player</h1>
        <form action="cadastrar_player.php" method="POST">
            <label for="nickname">Nickname</label>
            <input type="text" id="nickname" name="nickname" required>

            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Cadastrar</button>
        </form>
    </div>

</body>
</html>
