<?php session_start();

$sessao = $_SESSION['ses_id'];

include "../../mysqlconecta.php";

if (!$conexao) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['monstro_id']) && !empty($_POST['bloco_id'])) {
        
        $monstro = $_POST['monstro_id']; 
        $valor = $_POST['monstro_valor']; 
        $bloco = $_POST['bloco_id'];
        
        $query_monstro = "INSERT INTO monstros_sessao (ses_id, mon_id, ms_bloco) 
                  VALUES ($sessao, $monstro, $bloco)";
        
        if (mysqli_query($conexao, $query_monstro)) {

            $query_creditos = "UPDATE mestre
                               SET mes_creditos = (mes_creditos - $valor)
                               WHERE ses_id = $sessao;";
            mysqli_query($conexao, $query_creditos);

            header("Location: monstros.php");
            exit();
        } else {
            echo "<p>Erro ao adicionar monstro: " . mysqli_error($conexao) . "</p>";
        }
    }
}


$query_mestre ="SELECT *
                FROM mestre
                WHERE ses_id = $sessao";

$result_mestre = mysqli_query($conexao, $query_mestre);

$mestre = mysqli_fetch_array($result_mestre);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The King's Will</title>
    <link rel="stylesheet" href="../../../css/general/fonts.css">
    <link rel="stylesheet" href="../../../css/game/elements/components.css">
    <link rel="stylesheet" href="../../../css/game/elements/animations.css">
    <link rel="stylesheet" href="../../../css/game/elements/attributes.css">
    <link rel="stylesheet" href="../../../css/game/mestre.css">
</head>

<body>
    
    <div class="container">

        <div class="grid">
            <?php
                include "../../mysqlconecta.php";
                $sessao = $_SESSION['ses_id'];

                for ($bloco = 1; $bloco <= 9; $bloco++) {

                    $query = "SELECT ms_status FROM monstros_sessao 
                            WHERE ses_id = $sessao AND ms_bloco = $bloco";
                    $result = mysqli_query($conexao, $query);

                    $total = 0;
                    $vivos = 0;

                    while ($row = mysqli_fetch_assoc($result)) {
                        $total++;
                        if ($row['ms_status'] == 1) {
                            $vivos++;
                        }
                    }

                    // Define se o bloco deve ser desativado
                    $desativado = $total >= 5 ? "desativado" : "";

                    echo "<div class='bloco $desativado white' data-bloco='$bloco'>";
                    echo "<div class='contador subtitle mediumT white'>$vivos monstros vivos<br>$total/5</div>";
                    echo "</div>";
                }
            ?>
        </div>

        <div class="perfil largeBS orangeBC solid">
            <?php if ($mestre): ?>
                <div class="info-mestre text">
                    <div class="item-mestre">
                        <strong>Turnos(XP):</strong> 
                        <div class="barra-xp">
                            <div class="nivel titleV"><?= $mestre['mes_lvl'] ?></div>

                            <?php
                            
                                for ($t=0; $t < $mestre['mes_turnos']; $t++) { ?>
                                    
                                    <div class="turnos"></div>

                                <?php } ?>
                            <div class="prox-nivel titleV"><?= ($mestre['mes_lvl'] + 1) ?></div>  
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>


    </div>


    <div class="mercado dark-grayBT">
        <div class="creditos subtitle bold"><?= $mestre['mes_creditos'] ?>¢</div>
        
        <div class="conteudo-mercado">
            <?php

                $query = "SELECT * FROM monstros ORDER BY mon_natureza, mon_nome, mon_valor";
                $result = mysqli_query($conexao, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                    switch ($row["mon_natureza"]) {
                        case 'Sangue':
                            $classe = "monstro sangue solid redB dark-redBC white";
                            break;
                        case 'Visceras':
                            $classe = "monstro visceras solid light-purpleB purpleBC purple";
                            break;
                        case 'Ossos':
                            $classe = "monstro ossos solid whiteB grayBC black";
                            break;
                        case 'Consciencia':
                            $classe = "monstro consciencia solid blueB dark-blueBC dark-blue";
                            break;
                        case 'Base':
                        default:
                            $classe = "monstro base solid grayB dark-grayBC white";
                    }

                    $classe_extra = ($row['mon_valor'] > $mestre['mes_creditos']) ? "desativado" : "";

                    echo "<div class='$classe $classe_extra' data-valor='{$row['mon_valor']}' data-id='{$row['mon_id']}'>";

                    echo "<div class='nome subtitle mediumT'>" . $row["mon_nome"] . "</div>";

                    echo "<img src='" . $row["mon_icone"] . "' alt='" . $row["mon_nome"] . "' class='imagem'>";

                    echo "<div class='atributos text'>";

                    // VIDA
                    $vida = min($row["mon_HP"], 100);
                    echo "<div class='atributo'>
                            <strong>HP</strong>
                            <div class='barra'>
                                <span class='bold text'>{$row['mon_HP']}</span>
                                <div class='barra-interna' style='width: {$vida}%'></div>
                            </div>
                        </div>";

                    // ATAQUE
                    $ataque = min($row["mon_STR"], 30) * (10/3);
                    echo "<div class='atributo'>
                            <strong>FOR</strong>
                            <div class='barra'>
                                <span class='bold text'>{$row['mon_STR']}</span>
                                <div class='barra-interna' style='width: {$ataque}%'></div>
                            </div>
                        </div>";

                    // AGILIDADE
                    $agilidade = min($row["mon_AGI"], 30) * (10/3);
                    echo "<div class='atributo'>
                            <strong>AGI</strong>
                            <div class='barra'>
                                <span class='bold text'>{$row['mon_AGI']}</span>
                                <div class='barra-interna' style='width: {$agilidade}%'></div>
                            </div>
                        </div>";

                    echo "</div>"; // atributos
                    echo "<div class='valor subtitle bold'>{$row['mon_valor']}¢</div>";
                    echo "</div>"; // monstro
                }

                } else {
                    echo "<p>Nenhum monstro cadastrado.</p>";
                }
                $conexao->close();
            ?>
        </div>

    </div>

</body>
<form id="form-selecao" action="" method="POST">
    <input type="hidden" name="monstro_id" id="input-monstro">
    <input type="hidden" name="monstro_valor" id="input-valor">
    <input type="hidden" name="bloco_id" id="input-bloco">
</form>

<script>
    let monstroSelecionado = null;
    let blocoSelecionado = null;

    const inputMonstro = document.getElementById('input-monstro');
    const inputValor = document.getElementById('input-valor')
    const inputBloco = document.getElementById('input-bloco');
    const form = document.getElementById('form-selecao');


    document.querySelectorAll('.monstro').forEach(monstro => {
        monstro.addEventListener('click', () => {
            if (monstro.classList.contains('desativado')) return;

            document.querySelectorAll('.monstro').forEach(m => m.classList.remove('marcado'));
            monstro.classList.add('marcado');
            monstroSelecionado = monstro;
            inputMonstro.value = monstro.getAttribute('data-id');
            inputValor.value = monstro.getAttribute('data-valor');
            checarEnvio();
        });
    });


    document.querySelectorAll('.bloco').forEach(bloco => {
        bloco.addEventListener('click', () => {

            document.querySelectorAll('.bloco').forEach(b => b.classList.remove('marcado'));

            bloco.classList.add('marcado');
            blocoSelecionado = bloco;

            inputBloco.value = bloco.getAttribute('data-bloco');

            checarEnvio();
        });
    });

    function checarEnvio() {
        if (monstroSelecionado && blocoSelecionado) {
            if (!document.getElementById('botao-enviar')) {
                const botao = document.createElement('button');
                botao.type = 'submit';
                botao.id = 'botao-enviar';
                botao.textContent = 'Sumonar';
                botao.classList.add('botao');

                form.appendChild(botao);
            }
        }
    }

</script>

<a href="mestre.php" class="sair subtitle">VOLTAR</a>