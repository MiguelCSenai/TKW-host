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
    if (
        !empty($_POST['nome']) &&
        !empty($_POST['descricao']) &&
        isset($_POST['conjuracao']) &&
        !empty($_POST['img'])
    ) {
        $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
        $descricao = mysqli_real_escape_string($conexao, $_POST['descricao']);
        $conjuracao = (int) $_POST['conjuracao'];
        $icone = $_POST['img'];

        $query = "INSERT INTO magias (mag_nome, mag_descricao, mag_conjuracao, mag_icone) 
                VALUES ('$nome', '$descricao', $conjuracao, '$icone')";


        if (mysqli_query($conexao, $query)) {
            header("Location: addMagia.php");
            exit();
        } else {
            echo "<p>Erro ao adicionar magia: " . mysqli_error($conexao) . "</p>";
        }
    } else {
        echo "<p>Preencha todos os campos obrigatórios.</p>";
    }
}

$conexao->close();
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Magia</title>
    <link rel="stylesheet" href="../../../css/general/attributes.css">
    <link rel="stylesheet" href="../../../css/general/fonts.css">
    <link rel="stylesheet" href="../../../css/general/elements.css">
    <link rel="stylesheet" href="../../../css/admin/style.css">
    <link rel="stylesheet" href="../../../css/menu/style.css">
    <link rel="stylesheet" href="../../../css/home/animations.css">
</head>
<body>

<nav class="menu subtitle bold noSelect">
    <ul>
        <li><a href="../../home.php">Home</a></li>
        <li><a href="../../Catalogo/catalogo.php">Catálogo</a></li>
        <li><a href="../../Wiki/wiki.php">Como Jogar</a></li>
        <li><a onclick="ativarTransicao()">História</a></li>
        <li><a href="../../../../TheKingsWill.Game/php/MainMenu/main.php">Jogar</a></li>
        <li><a href="../menu.php"><?php echo $username; ?></a></li>
    </ul>
    <img class="noSelect" src="../../../resources/Livro.png" id="overlay">
    <div onclick="desativarTransicao()" id="overlayBackground"></div>
    <script src="../../../js/General/transitions.js"></script>
</nav>

<div class="container-form">
    <h1 class="subtitle red SdarkRed">Adicionar Magia ao Catálogo</h1>
    <form class="bold title redBC mediumBS solid light-redBT" action="" method="POST">
        <div class="form-group">
            <label for="nome">Nome da Magia:</label>
            <input type="text" id="nome" name="nome" maxlength="25" required>
        </div>
        <div class="form-group">
            <label for="descricao">Descrição da Magia:</label>
            <textarea id="descricao" name="descricao" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label for="conjuracao">Conjuração:</label>
            <input type="number" id="conjuracao" name="conjuracao" min="0" required>
        </div>

        <div class="form-group">
            <label for="img">url do icone:</label>
            <input type="text" id="img" name="img">
        </div>

        <button type="submit">Adicionar Magia</button>
    </form>
</div>


</body>
</html>
