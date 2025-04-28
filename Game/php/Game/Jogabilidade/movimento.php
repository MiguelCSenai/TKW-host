<?php
session_start();
include "../../mysqlconecta.php";

$player_id = $_SESSION['player_id'];
$query = "SELECT *
          FROM players WHERE pla_id = $player_id";
$result = mysqli_query($conexao, $query);
$player = mysqli_fetch_assoc($result);

$raio = (int) ($player['pla_AGI'] / 2);

$coresFria = ['#4A90E2','#50E3C2','#9013FE','#B8E986'];
$coresQuente = ['#F5A623','#D0021B','#F8E71C','#F56A79'];
$corPlayer = ($player['pla_reino']==1 ? $coresFria[0] : $coresQuente[0]);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movimento Mobile</title>
  <link rel="stylesheet" href="../../../css/game/movimento.css">
<style>

    .player-icon {
      position: absolute;
      width: calc(250px/20 - 2px);
      height: calc(250px/20 - 2px);
      border-radius: 50%;
      background-color: <?= $corPlayer ?>;
      pointer-events: none;
      box-shadow: 0 0 5px rgba(0,0,0,0.5);
    }

</style>
</head>
<body>
  <div class="map-view">
    <div class="grid-centro" id="gridCentro">
      <?php
      // Gera 3x3 blocos
      for($b=1;$b<=9;$b++): ?>
        <div class="bloco-centro">
          <div class="grid-celulas">
            <?php for($y=1;$y<=20;$y++):
              for($x=1;$x<=20;$x++):
                // Só marca área de movimento dentro do bloco do jogador
                $classe = '';
                if($b == $player['pla_bloco']){
                  $dist = abs($player['pla_x'] - $x) + abs($player['pla_y'] - $y);
                  if($dist <= $raio) $classe = ' celula-movimento';
                }
                echo "<div id='celula-{$b}-{$y}-{$x}' class='celula{$classe}' data-bloco='$b' data-linha='$y' data-coluna='$x'></div>";
              endfor;
            endfor; ?>
          </div>
          <?php if($b == $player['pla_bloco']):
            $l = ($player['pla_x']-1)*(252/20);
            $t = ($player['pla_y']-1)*(252/20);
          ?>
            <div class="player-icon" style="left:<?=$l?>px; top:<?=$t?>px;"></div>
          <?php endif; ?>
        </div>
      <?php endfor; ?>
    </div>
  </div>

  <script>
    (() => {
      const blocoAtivo = <?= $player['pla_bloco'] - 1 ?>; // 0-based
      const cols = 3, size = 250;
      const xIdx = blocoAtivo % cols;
      const yIdx = Math.floor(blocoAtivo/cols);
      const view = document.querySelector('.map-view');
      const grid = document.getElementById('gridCentro');

      // Calcular offset para colocar bloco ativo no centro do viewport
      const cx = view.clientWidth/2 - size/2;
      const cy = view.clientHeight/2 - size/2;
      const tx = cx - xIdx*size;
      const ty = cy - yIdx*size;

      grid.style.transform = `translate(${tx}px, ${ty}px)`;
    })();
  </script>
</body>
</html>
