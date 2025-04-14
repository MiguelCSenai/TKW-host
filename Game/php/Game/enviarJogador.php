<?php session_start();

    include "../mysqlconecta.php";

    $atributos = [
        'Guerreiro' => ['HP' => 40, 'STR' => 9, 'AGI' => 11, 'INT' => 6],
        'Mago' => ['HP' => 20, 'STR' => 5, 'AGI' => 8, 'INT' => 12],
        'Armadilheiro' => ['HP' => 15, 'STR' => 3, 'AGI' => 14, 'INT' => 11],
        'Arqueiro' => ['HP' => 30, 'STR' => 7, 'AGI' => 13, 'INT' => 9],
    ];
    
    $classe = $_POST['classeP'];
    $nome = $_POST['nickP'];
    $reino = $_POST['reinoP'];
    
    $ses_id = $_SESSION['ses_id'];
    
    $stats = $atributos[$classe];
    
    $query = "INSERT INTO players (pla_nome, pla_classe, pla_reino, pla_HP, pla_STR, pla_AGI, pla_INT, pla_ses_id)
              VALUES ('$nome', '$classe', '$reino', {$stats['HP']}, {$stats['STR']}, {$stats['AGI']}, {$stats['INT']}, '$ses_id')";
    

    if (mysqli_query($conexao, $query)) {

        $_SESSION['nome'] = $nome;
        $_SESSION['classe'] = $classe;
        $_SESSION['reino'] = $reino;
        $_SESSION['max_hp'] = $stats['HP'];
        header("Location: ./Jogabilidade/playerIndex.php");
        exit();
    } else {
        echo "<p>Erro ao cadastrar jogador: " . mysqli_error($conexao) . "</p>";
    }

?>