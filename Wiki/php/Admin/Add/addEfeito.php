<?php session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['admin'];

include "../../mysqlconecta.php";

if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
    $nome = $_POST['nome'];
    $desc = $_POST['desc'];
    $cor = $_POST['cor'];
    
    $query = "INSERT INTO efeitos (eft_nome, eft_descricao, eft_cor) 
                VALUES ('$nome', '$desc', '$cor')";
    
    if (mysqli_query($conexao, $query)) {
        header("Location: addEfeito.php");
        exit();
    } else {
        echo "<p>Erro ao adicionar efeito: " . mysqli_error($conexao) . "</p>";
    }
}

$conexao->close();

?>



<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The King's Will - Admin | Catálogo</title>
    <link rel="stylesheet" href="../../../css/general/attributes.css">
    <link rel="stylesheet" href="../../../css/general/fonts.css">
    <link rel="stylesheet" href="../../../css/general/elements.css">
    <link rel="stylesheet" href="../../../css/admin/style.css">
    <link rel="stylesheet" href="../../../css/menu/style.css">
    <link rel="stylesheet" href="../../../css/home/animations.css">
</head>
<body>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Armas</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="menu subtitle bold noSelect">
        <ul>
            <li><a href="../../home.php">Home</a></li>
            <li><a href="../../Catalogo/catalogo.php">Catálogo</a></li>
            <li><a href="../../Wiki/wiki.php">Como Jogar</a></li>
            <li><a onclick="ativarTransicao()">História</a></li>
            <li><a href="../../../../TheKingsWill.Game/php/MainMenu/main.php">Jogar</a></li>
            <li><a href="../menu.php"><?php if (isset($_SESSION['admin'])) { echo $_SESSION['admin']; }else{ echo "Administrador"; } ?></a></li>

        </ul>
        <img class="noSelect" src="../../../resources/Livro.png" id="overlay">
        <div onclick="desativarTransicao()" id="overlayBackground"></div>

        <script src="../../../js/General/transitions.js"></script>

    </nav>

    <div class="container-form">

        <h1 class="subtitle red SdarkRed">Adicionar Arma ao Catálogo</h1>
        <form class="bold title redBC mediumBS solid light-redBT" action="" method="POST">
            <div class="form-group">
                <label for="nome">Nome do Efeito:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="nome">Descrição:</label>
                <input type="text" id="desc" name="desc" required>
            </div>
            <div class="form-group">
                <label for="nome">Cor:</label>
                <input type="color" name="cor" id="cor">
            </div>
            <button type="submit">Adicionar Efeito</button>
        </form>

    </div>
    
</body>
</html>


</body>
</html>