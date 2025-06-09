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
        !empty($_POST['natureza']) &&
        isset($_POST['HP']) &&
        isset($_POST['STR']) &&
        isset($_POST['AGI']) &&
        isset($_POST['INT']) &&
        isset($_POST['xp']) &&
        isset($_POST['EVA'])
    ){    
        $nome = $_POST['nome'];
        $natureza = $_POST['natureza'];
        $HP = (int) $_POST['HP'];
        $STR = (int) $_POST['STR'];
        $AGI = (int) $_POST['AGI'];
        $INT = (int) $_POST['INT'];
        $EVA = (int) $_POST['EVA'];
        $xp = (int) $_POST['xp'];
        $icone = !empty($_POST['icone']) ? $_POST['icone'] : NULL;

        $query = "INSERT INTO monstros (mon_nome, mon_natureza, mon_HP, mon_STR, mon_AGI, mon_INT, mon_EVA, mon_xp, mon_icone) 
                  VALUES ('$nome', '$natureza', $HP, $STR, $AGI, $INT, $EVA, $xp, " . ($icone ? "'$icone'" : "NULL") . ")";

        
        if (mysqli_query($conexao, $query)) {
            header("Location: addMonstro.php");
            exit();
        } else {
            echo "<p>Erro ao adicionar monstro: " . mysqli_error($conexao) . "</p>";
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
    <title>Adicionar Monstro</title>
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
    <h1 class="subtitle red SdarkRed">Adicionar Monstro ao Catálogo</h1>
    <form class="bold title redBC mediumBS solid light-redBT" action="" method="POST">
        <div class="form-group">
            <label for="nome">Nome do Monstro:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="natureza">Natureza do Monstro:</label>
            <select id="natureza" name="natureza" required>
                <option disabled selected>Selecione uma natureza:</option>
                <option value="Base">Base</option>
                <option value="Consciência">Consciência</option>
                <option value="Ossos">Ossos</option>
                <option value="Sangue">Sangue</option>
                <option value="Vísceras">Vísceras</option>
            </select>
        </div>
        <div class="form-group">
            <label for="HP">Vida (HP):</label>
            <input type="number" id="HP" name="HP" min="1" required>
        </div>
        <div class="form-group">
            <label for="STR">Força (STR):</label>
            <input type="number" id="STR" name="STR" min="0" required>
        </div>
        <div class="form-group">
            <label for="AGI">Agilidade (AGI):</label>
            <input type="number" id="AGI" name="AGI" min="0" required>
        </div>
        <div class="form-group">
            <label for="INT">Inteligência (INT):</label>
            <input type="number" id="INT" name="INT" min="0" required>
        </div>
        <div class="form-group">
            <label for="EVA">Evasão (EVA):</label>
            <input type="number" id="EVA" name="EVA" min="0" required>
        </div>
        <div class="form-group">
            <label for="xp">XP Concedido:</label>
            <input type="number" id="xp" name="xp" min="0" required>
        </div>
        <div class="form-group">
            <label for="icone">Ícone do Monstro:</label>
            <input type="text" id="icone" name="icone" placeholder="Link da imagem do monstro">
        </div>

        <button type="submit">Adicionar Monstro</button>
    </form>
</div>

</body>
</html>
