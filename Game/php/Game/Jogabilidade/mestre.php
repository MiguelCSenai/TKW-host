<?php
session_start();
include "../../mysqlconecta.php";

$sessao = $_SESSION['ses_id'];

$query_mestre ="SELECT *
                FROM mestre
                WHERE ses_id = $sessao";

$result_mestre = mysqli_query($conexao, $query_mestre);

$mestre = mysqli_fetch_array($result_mestre);

$query_turno = "SELECT tur_ordem, tur_atual FROM turnos WHERE tur_ses_id = $sessao";
$result_turno = mysqli_query($conexao, $query_turno);
$dados_turno = mysqli_fetch_assoc($result_turno);

$ordem = json_decode($dados_turno['tur_ordem'] ?? '[]', true);
$turno_atual = $dados_turno['tur_atual'] ?? null;

$nome_turno = 'Desconhecido';

if ($turno_atual !== null) {
    if (is_numeric($turno_atual)) {
        $q = mysqli_query($conexao, "SELECT pla_nome FROM players WHERE pla_id = $turno_atual");
        $p = mysqli_fetch_assoc($q);
        $nome_turno = $p['pla_nome'] ?? 'Jogador desconhecido';
    } elseif (strtoupper($turno_atual) === 'MESTRE') {
        $nome_turno = 'Mestre';
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The King's Will</title>
    <link rel="stylesheet" href="../../../css/general/fonts.css">
    <link rel="stylesheet" href="../../../css/game/elements/components.css">
    <link rel="stylesheet" href="../../../css/game/elements/animations.css">
    <link rel="stylesheet" href="../../../css/game/elements/attributes.css">
    <link rel="stylesheet" href="../../../css/game/menu-mestre.css">
</head>

<a href="../../../../Game/php/Game/sair.php" class="sair subtitle">FINALIZAR SESSÃO</a>

    <div class="tela-inicial" id="telaInicial">
        <div class="menu-items">

            <a href="status_player.php" class="subtitle mediumT bold red SdarkRed">Status players</a>
            <a href="status_monstros.php" class="subtitle mediumT bold red SdarkRed">Status monstros</a>
            <a href="alterar_turnos.php" class="subtitle mediumT bold red SdarkRed">Definir turnos</a>

        </div>
    </div>

    <div class="turno-container redBC solid largeBS">
        <div class="turno-info text">
            <strong class="subtitle red">Turno atual:</strong>
            <div class="turno-nome text bold bigT"><?= $nome_turno ?></div>
        </div>
        <form method="post" action="passar_turno.php">
            <button type="submit" class="botao-passar-turno subtitle bold red">Passar Turno</button>
        </form>
    </div>


    <div class="container">

        <div class="button-container">
            <div class="icon-button" id="armadilhas">
                <img src="../../../resources/img/armadilha.png" alt="Armadilhas" class="icon-img">
            </div>
            <div class="icon-button" id="monstros">
                <img src="../../../resources/img/monstros.png" alt="Monstros" class="icon-img">
            </div>
            <div class="icon-button" id="trocar">
                <img src="../../../resources/img/trocar.png" alt="Trocar" class="icon-img">
            </div>
        </div>

        <div class="perfil largeBS redBC solid">
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

</body>
</html>

<script>

document.addEventListener('DOMContentLoaded', function() {

    const buttons = document.querySelectorAll('.icon-button');
    
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const buttonId = this.id;
            switch (buttonId) {
                case 'armadilhas':
                    window.location.href = 'armadilhas.php';
                    break;
                case 'monstros':
                    window.location.href = 'monstros.php';
                    break;
                case 'trocar':
                    window.location.href = 'trocar.php';
                    break;
            }
        });
    });
});

</script>


<?php
mysqli_close($conexao);
?>