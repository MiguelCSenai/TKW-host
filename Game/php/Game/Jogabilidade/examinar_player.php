<?php session_start();
include "../../mysqlconecta.php";
    $sessao = $_SESSION['ses_id'];

    $player_id = $_GET['id'];

    #query pra achar o player
    $query_player = "SELECT * 
                      FROM players 
                      WHERE pla_ses_id = $sessao
                      AND pla_id = $player_id";
    $result_player = mysqli_query($conexao, $query_player);
    $player = mysqli_fetch_assoc($result_player);

    #query pra puxar o inventario do player
    $query_items = "SELECT i.itm_id, inv.inv_id, i.itm_nome, i.itm_tipo, i.itm_efeito, i.itm_img, COUNT(*) as quantidade
                    FROM items i
                    JOIN inventario inv ON i.itm_id = inv.itm_id
                    WHERE inv.pla_id = {$player_id}
                    GROUP BY i.itm_id, i.itm_nome, i.itm_tipo, i.itm_efeito, i.itm_img
";

    $result_items = mysqli_query($conexao, $query_items);
    $items = [];
    while ($row = mysqli_fetch_assoc($result_items)) {
        $items[] = $row;
    }

    #query para puxar as armas do player
    $query_armas = "SELECT a.wpn_id, a.wpn_nome, a.wpn_tipo, a.wpn_natureza, a.wpn_efeito,
                           a.wpn_dano, a.wpn_velocidade, a.wpn_alcance, a.wpn_icone, a.wpn_descricao
                    FROM armas a
                    JOIN inventario inv ON a.wpn_id = inv.wpn_id
                    WHERE inv.pla_id = {$player_id}";
    $result_armas = mysqli_query($conexao, $query_armas);
    $armas = [];

    while ($row = mysqli_fetch_assoc($result_armas)) {
        $armas[] = $row;
    }


    #query para puxar as magias do jogador
    $query_magias = "SELECT m.mag_id, m.mag_nome, m.mag_descricao, m.mag_conjuracao, m.mag_icone
                     FROM magias m
                     JOIN inventario inv ON m.mag_id = inv.mag_id
                     WHERE inv.pla_id = {$player_id}";

    $result_magias = mysqli_query($conexao, $query_magias);

    $magias = [];

    while ($row = mysqli_fetch_assoc($result_magias)) {
        $magias[] = $row;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $player['pla_nome'] ?></title>
    <link rel="stylesheet" href="../../../css/general/fonts.css">
    <link rel="stylesheet" href="../../../css/game/elements/components.css">
    <link rel="stylesheet" href="../../../css/game/elements/animations.css">
    <link rel="stylesheet" href="../../../css/game/elements/attributes.css">
    <link rel="stylesheet" href="../../../css/game/examinar.css">
</head>
<body>

    <div class="container-inventario">

        <div class="conteudo-inventario">

            <div class="mini-container">

                <?php if(empty($items)){ ?>
                    <p class="nada subtitle red bold smallT">Nenhum item no inventário.</p>
                <?php }else{ ?>

                    <p class="titulo subtitle red bold smallT">INVENTARIO</p>

                <?php } ?>

                <div class="conteudo">

                    
                    <?php foreach ($items as $item): ?>
                        <div class="item-card">
                            <?php if (!empty($item['itm_img'])): ?>
                                <img src="<?= $item['itm_img'] ?>" alt="<?= $item['itm_nome'] ?>" class="item-img">
                            <?php endif; ?>
                            <h3 class="text white bold"><?= $item['itm_nome'] ?></h3>
                            <p class="quantidade text white">x<?= $item['quantidade'] ?></p>

                            <button class="white bold text" onclick="deletar('um', 'item', <?= $item['itm_id'] ?>)">Remover um</button>
                            <button class="white bold text" onclick="deletar('todos', 'item', <?= $item['itm_id'] ?>)">Remover todos</button>

                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
            <div class="mini-container">

                <?php if(empty($armas)): ?>
                    <p class="nada subtitle red bold smallT">Nenhuma arma no inventário.</p>
                <?php endif; ?>

                <div class="conteudo-armas">

                    <?php foreach ($armas as $arma): ?>
                        <?php
                            switch ($arma['wpn_natureza']) {
                                case 'Base':
                                    $classe = "grayB dark-grayBC white";
                                    $classeImg = "base";
                                    break;
                                case 'Sangue':
                                    $classe = "redB dark-redBC white";
                                    $classeImg = "sangue";
                                    break;
                                case 'Vísceras':
                                    $classe = "light-purpleB purpleBC white";
                                    $classeImg = "visceras";
                                    break;
                                case 'Ossos':
                                    $classe = "whiteB grayBC black";
                                    $classeImg = "ossos";
                                    break;
                                case 'Consciência':
                                    $classe = "light-blueB blueBC darkBlue";
                                    $classeImg = "consciencia";
                                    break;
                                default:
                                    $classe = "grayB dark-grayBC white";
                                    $classeImg = "base";
                                    break;
                            }
                        ?>
                        <div class="<?= $classe ?> solid mediumBS arma text">
                            <div class="icon">
                                <h2><?= $arma['wpn_nome'] ?></h2>
                            </div>
                            <div class="content">
                                <div class="stats-arma">
                                    <p><strong class="subtitle">Tipo:</strong> <?= $arma['wpn_tipo'] ?></p>
                                    <p><strong class="subtitle">Efeito:</strong> <?= $arma['wpn_efeito'] ?></p>

                                    <!--<div class="stat-group-arma">
                                        <strong class="subtitle">Dano:</strong>
                                        <div class="stat-bar-arma">
                                            <span class="stat-num-arma"><?= min($arma['wpn_dano'], 10) ?> / 10</span>
                                            <div class="stat-fill-arma" style="width: <?= min($arma['wpn_dano'], 10) * 10 ?>%"></div>
                                        </div>
                                    </div>

                                    <div class="stat-group-arma">
                                        <strong class="subtitle">Velocidade:</strong>
                                        <div class="stat-bar-arma">
                                            <span class="stat-num-arma"><?= min($arma['wpn_velocidade'], 4) ?> / 4</span>
                                            <div class="stat-fill-arma" style="width: <?= min($arma['wpn_velocidade'], 4) * 25 ?>%"></div>
                                        </div>
                                    </div>

                                    <div class="stat-group-arma">
                                        <strong class="subtitle">Alcance:</strong>
                                        <div class="stat-bar-arma">
                                            <span class="stat-num-arma"><?= min($arma['wpn_alcance'], 10) ?> / 10</span>
                                            <div class="stat-fill-arma" style="width: <?= min($arma['wpn_alcance'], 10) * 10 ?>%"></div>
                                        </div>
                                    </div>-->
                                    <button class="white bold text" onclick="deletar('um', 'arma', <?= $arma['wpn_id'] ?>)">Remover</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>

            </div>
            <div class="mini-container">

                <?php if(empty($magias)): ?>
                    <p class="nada subtitle red bold smallT">Nenhuma magia no inventário.</p>
                <?php endif; ?>

                <div class="conteudo-magia">

                    <?php foreach ($magias as $magia): ?>
                        <div class="magia solid mediumBS text">
                            <div class="icon">
                                <?php if(!empty($magia['mag_icone'])): ?>
                                    <img src="<?= $magia['mag_icone'] ?>" alt="<?= $magia['mag_nome'] ?>" />
                                <?php else: ?>
                                    <img src="../../../resources/default_magic_icon.png" alt="Ícone padrão" />
                                <?php endif; ?>
                                <h2 class="textV" style="font-size: 3em; margin-block: 0"><?= $magia['mag_nome'] ?></h2>
                            </div>
                            <div class="content">
                                <p style="text-align: center; width: 100%; font-size: 1.5em;"><strong class="subtitle">Descrição:</strong></p>
                                <p class="descricao-mag" style="text-align:center;"><?= $magia['mag_descricao'] ?></p>

                                <p><strong class="subtitle">Tempo de conjuração:</strong> <?= $magia['mag_conjuracao'] ?> Turnos</p>
                            </div>
                            <button class="white bold text" onclick="deletar('um', 'magia', <?= $magia['mag_id'] ?>)">Remover</button>
                        </div>
                    <?php endforeach; ?>

                </div>

            </div>

        </div>

    </div>

    <div class="personagem-wrapper">

    <div class="efeitos-player">
        <?php 
            $queryEfeitosPlayer = "SELECT e.eft_id, e.eft_nome, inv.eft_duracao, e.eft_cor 
                                FROM efeitos e
                                JOIN inventario inv ON e.eft_id = inv.eft_id
                                WHERE inv.pla_id = $player_id AND inv.eft_id IS NOT NULL AND inv.eft_duracao > 0";
            $resEfeitosPlayer = mysqli_query($conexao, $queryEfeitosPlayer);

            while ($efeitosPlayer = mysqli_fetch_assoc($resEfeitosPlayer)): ?>
                <div class="icon-efeito white bold text" style="background-color: <?= $efeitosPlayer['eft_cor'] ?>">
                    <div class="info">
                        <span class="nome"><?= $efeitosPlayer['eft_nome'] ?></span>
                        <span class="duracao"><?= $efeitosPlayer['eft_duracao'] . ($efeitosPlayer['eft_duracao'] != 1 ? " turnos" : " turno") ?></span>
                    </div>
                    <a href="retirar_efeito.php?efeito=<?= $efeitosPlayer['eft_id'] ?>&player=<?= $player_id ?>" class="excluir">Remover</a>
                </div>  
                                
        <?php endwhile; ?>
    </div>

    <!-- Ficha do personagem -->
    <div class="container-personagem">
        <p class="subtitle bold bigT"><?php echo $player['pla_nome']; ?></p>

        <div class="xp-container">
            <?php
                $xp = $player['pla_xp'];
                $xpMax = 10 * $player['pla_lvl'];
                $xpPercent = min(100, ($xp / $xpMax) * 100);
            ?>
            <div class="xp-bar">
                <div class="xp-fill" style="width: <?php echo $xpPercent; ?>%;"></div>
                <div class="xp-text"><?php echo $xp; ?> / <?php echo $xpMax; ?> XP</div>
                <div class="level-container"><?php echo $player['pla_lvl']; ?></div>
            </div>
        </div>

        <p class="subtitle bold smallT">Prisioneiro do reino <?php echo $player['pla_reino']; ?></p>  

        <div class="stats">
            <?php
            $stats = [
                "pla_HP" => "HP",
                "pla_STR" => "FOR",
                "pla_AGI" => "AGI",
                "pla_INT" => "INT",
                "pla_EVA" => "EVA"
            ];

            foreach ($stats as $key => $atributo) {
                $valor = $player[$key];
                if ($key === 'pla_HP') {
                    $max = $player['pla_Max_HP'];
                } elseif ($key === 'pla_Max_HP') {
                    $max = 999;
                } elseif ($key === 'pla_STR' || $key === 'pla_INT') {
                    $max = 25;
                } elseif ($key === 'pla_EVA') {
                    $max = 15;
                } else {
                    $max = 20;
                }
                $porcentagem = min(100, ($valor / $max) * 100);
                echo "
                <div class='stat'>
                    <strong class='subtitle'>{$atributo}:</strong>
                    <div class='stat-bar'>
                        <span class='stat-num'>{$valor} / {$max}</span>
                        <div class='stat-fill' style='width: {$porcentagem}%;'></div>
                    </div>
                </div>
                ";
            }
            ?>
        </div>

        <a href="editar_stats.php?player_id=<?= $player_id ?>" class="editarStats subtitle bold">Editar Stats</a>
    </div>
</div>


    <div class="container-efeitos">

        <?php
        
            $query_efeitos = "SELECT * FROM efeitos";
            $result_efeitos = mysqli_query($conexao, $query_efeitos);

            $efeitos = [];

            while ($row = mysqli_fetch_assoc($result_efeitos)) {
                $efeitos[] = $row;
            }
            
        ?>

        <div class="conteudo-efeitos">

            <?php foreach ($efeitos as $efeito): ?>
            
                <div class="item-card whiteBC" onclick="abrirConfirmacao('<?= $efeito['eft_id'] ?>',
                                                                         '<?= addslashes($efeito['eft_nome']) ?>',
                                                                         '<?= addslashes($player['pla_nome']) ?>')"
                                                                         style="background-color: <?= $efeito['eft_cor'] ?>">


                    <h3 class="text white bold"><?= $efeito['eft_nome'] ?></h3>
                    <p class="text white"><?= $efeito['eft_descricao'] ?></p>

                </div>
            <?php endforeach; ?>

        </div>        

    </div>

    <a href="mestre.php" class="sair subtitle">VOLTAR</a>

    <div id="modal-confirmacao" class="modal" style="display:none;">
        <div class="modal-content whiteBC solid mediumBS">
            <span id="modal-fechar" class="close">&times;</span>
            <p id="modal-texto" class="subtitle bold"></p>
            <input type="number" name="turnos" id="turnos">
            <div class="button-container">

                <button id="confirmar-btn" class="greenB bold text white">Confirmar</button>
                <button id="cancelar-btn" class="redB bold text white">Cancelar</button>

            </div>
        </div>
    </div>

    
</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const limiteCaracteres = 60;

        document.querySelectorAll(".descricao-mag").forEach(paragrafo => {
            const textoOriginal = paragrafo.innerHTML;

            if (textoOriginal.length > limiteCaracteres) {
                const textoCortado = textoOriginal.slice(0, limiteCaracteres);
                const restante = textoOriginal.slice(limiteCaracteres);

                const spanResumo = document.createElement("span");
                spanResumo.innerHTML = textoCortado + "... ";

                const spanRestante = document.createElement("span");
                spanRestante.innerHTML = restante;
                spanRestante.style.display = "none";

                const botaoVerMais = document.createElement("button");
                botaoVerMais.textContent = "Ver mais";
                botaoVerMais.style.marginLeft = "5px";
                botaoVerMais.style.cursor = "pointer";
                botaoVerMais.className = "subtitle";

                botaoVerMais.addEventListener("click", function () {
                    if (spanRestante.style.display === "none") {
                        spanRestante.style.display = "inline";
                        botaoVerMais.textContent = "Ver menos";
                    } else {
                        spanRestante.style.display = "none";
                        botaoVerMais.textContent = "Ver mais";
                    }
                });

                // Limpa o conteúdo e reconstrói com "Ver mais"
                paragrafo.innerHTML = "";
                paragrafo.appendChild(spanResumo);
                paragrafo.appendChild(spanRestante);
                paragrafo.appendChild(botaoVerMais);
            }
        });
    });
</script>

<script>
function deletar(quanto, tipo, id) {
    fetch('delete_inventario.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `quanto=${quanto}&tipo=${tipo}&id=${id}&pla_id=<?= $player_id ?>`
    })
    .then(response => response.text())
    .then(data => {
        if (data === 'ok') {
            location.reload();
        } else {
            alert("Erro ao remover: " + data);
        }
    })
    .catch(error => {
        alert("Erro de conexão.");
        console.error(error);
    });
}
</script>
<script>
function abrirConfirmacao(eft_id, efeitoNome, playerNome) {
    const modal = document.getElementById("modal-confirmacao");
    const texto = document.getElementById("modal-texto");
    const confirmarBtn = document.getElementById("confirmar-btn");
    const turnosInput = document.getElementById("turnos");

    texto.innerHTML = `Deseja adicionar o efeito ${efeitoNome} ao jogador ${playerNome}?`;
    modal.style.display = "flex";

    confirmarBtn.onclick = function () {
        const turnos = encodeURIComponent(turnosInput.value.trim());

        fetch("adicionar_efeito.php", {
            method: "POST",
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `pla_id=<?= $player_id ?>&eft_id=${eft_id}&turnos=${turnos}`
        })
        .then(response => response.text())
        .then(data => {
            if (data === 'ok') {
                location.reload();
            } else {
                alert("Erro ao adicionar efeito: " + data);
            }
        });
        modal.style.display = "none";
    };
}

// Fecha o modal
document.getElementById("modal-fechar").onclick =
document.getElementById("cancelar-btn").onclick = function () {
    document.getElementById("modal-confirmacao").style.display = "none";
};
</script>
