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
    $tipo = $_POST['tipo'];
    $efeito = $_POST['efeito'];
    $potencia = (int)$_POST['potencia'];
    $imagem = $_POST['img'];

    $query = "INSERT INTO items (itm_nome, itm_tipo, itm_efeito, itm_potencia, itm_img) 
              VALUES ('$nome', '$tipo', '$efeito', $potencia, '$imagem')";

    if (mysqli_query($conexao, $query)) {
        header("Location: addItem.php");
        exit();
    } else {
        echo "<p>Erro ao adicionar item: " . mysqli_error($conexao) . "</p>";
    }
}

$conexao->close();
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The King's Will - Admin | Adicionar Item</title>
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
    <h1 class="subtitle red SdarkRed">Adicionar Item</h1>
    <form class="bold title redBC mediumBS solid light-redBT" action="" method="POST">
        <div class="form-group">
            <label for="nome">Nome do Item:</label>
            <input type="text" id="nome" name="nome" required>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="Poções">Poções</option>
                <option value="Armas secundarias">Armas secundarias</option>
            </select>
        </div>

        <div class="form-group">
            <label for="efeito">Efeito:</label>
            <select id="efeito" name="efeito" required>
                <option value="Cura">Cura</option>
                <option value="Corta veneno">Corta veneno</option>
                <option value="Coagulação">Coagulação</option>
                <option value="Dano">Dano</option>
            </select>
        </div>

        <div class="form-group">
            <label for="potencia">Potência:</label>
            <input type="number" id="potencia" name="potencia" min="1" required>
        </div>

        <div class="form-group">
            <label for="img">url do icone:</label>
            <input type="text" id="img" name="img">
        </div>

        <button type="submit">Adicionar Item</button>
    </form>
</div>

</body>
</html>
