<?php
session_start();
include "../../mysqlconecta.php";

$player_id = $_SESSION['player_id'];
$query = "SELECT *
          FROM players WHERE pla_id = $player_id";
$result = mysqli_query($conexao, $query);
$player = mysqli_fetch_assoc($result);

$query_turno = "SELECT tur_atual FROM turnos WHERE tur_ses_id = {$player['pla_ses_id']}";
$result_turno = mysqli_query($conexao, $query_turno);
$turno = mysqli_fetch_assoc($result_turno);

$eh_turno = $turno && $turno['tur_atual'] == $player_id;


$query_all = "SELECT pla_id, pla_x, pla_y, pla_bloco, pla_reino FROM players WHERE pla_ses_id = {$player['pla_ses_id']}";
$result_all = mysqli_query($conexao, $query_all);

$companheiros = [];
while ($p = mysqli_fetch_assoc($result_all)) {
    if ($p['pla_id'] != $player_id && $p['pla_reino'] == $player['pla_reino']) {
        $companheiros[] = $p;
    }
}

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
      width: calc(350px/20 - 2px);
      height: calc(350px/20 - 2px);
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
      for($b=1;$b<=9;$b++): ?>
        <div class="bloco-centro">
          <?php foreach ($companheiros as $c) {
            if ($c['pla_bloco'] != $b) continue;
            $cx = ($c['pla_x']-1)*(352/20);
            $cy = ($c['pla_y']-1)*(352/20);
            echo "<div class='player-icon' style='left:{$cx}px; top:{$cy}px; background-color:#999;'></div>";
          }
?>
          <div class="grid-celulas">
            <?php 
            for($y=1;$y<=20;$y++){
              for($x=1;$x<=20;$x++){
                $classe = '';
                if($b == $player['pla_bloco']){
                  $dist = abs($player['pla_x'] - $x) + abs($player['pla_y'] - $y);
                  if($dist <= $raio) $classe = ' celula-movimento';
                }
                foreach($companheiros as $comp) {
                  if ($comp['pla_bloco'] == $b && $comp['pla_x'] == $x && $comp['pla_y'] == $y) {
                      $classe .= ' celula-bloqueada';
                  }
                }
              
                echo "<div id='celula-{$b}-{$y}-{$x}' class='celula{$classe}' data-bloco='$b' data-linha='$y' data-coluna='$x'></div>";
              }
            } ?>
          </div>
          <?php if($b == $player['pla_bloco']):
            $l = ($player['pla_x']-1)*(352/20);
            $t = ($player['pla_y']-1)*(352/20);
          ?>
            <div class="player-icon" style="left:<?=$l?>px; top:<?=$t?>px;"></div>
          <?php endif; ?>
        </div>
      <?php endfor; ?>
    </div>
  </div>

</body>
</html>

<script>
(() => {
  const blocoAtivo = <?= $player['pla_bloco'] - 1 ?>;
  const cols = 3, size = 350;
  const xIdx = blocoAtivo % cols;
  const yIdx = Math.floor(blocoAtivo/cols);
  const view = document.querySelector('.map-view');
  const grid = document.getElementById('gridCentro');

  const cx = view.clientWidth/2 - size/2;
  const cy = view.clientHeight/2 - size/2;
  const tx = cx - xIdx*size;
  const ty = cy - yIdx*size;
  grid.style.transform = `translate(${tx}px, ${ty}px)`;


  const ehTurno = <?= $eh_turno ? 'true' : 'false' ?>;

  document.querySelectorAll('.celula-movimento').forEach(celula => {
  celula.addEventListener('click', async (e) => {
    if (!ehTurno) {
      alert("Aguarde sua vez.");
      return;
    }


      if (celula.classList.contains('celula-bloqueada')) return;

      const bloco = e.target.dataset.bloco;
      const linha = e.target.dataset.linha;
      const coluna = e.target.dataset.coluna;

      if (confirm(`Mover para linha ${linha}, coluna ${coluna}?`)) {
        try {
          const response = await fetch('atualiza_movimento.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `bloco=${bloco}&x=${coluna}&y=${linha}`
          });

          const result = await response.text();
          if (result.trim() === 'ok') {
            location.reload();
          } else {
            alert('Erro ao mover: ' + result);
          }
        } catch (err) {
          alert('Erro de conexão.');
        }
      }
    });
  });
})();
</script>
