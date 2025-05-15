<?php
session_start();
include "../../mysqlconecta.php";

$player_id = $_SESSION['player_id'];
$query = "SELECT * FROM players WHERE pla_id = $player_id";
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

$query_verifica = "SELECT COUNT(*) as total FROM monstros_sessao WHERE ses_id = {$player['pla_ses_id']}";
$res_verifica = mysqli_query($conexao, $query_verifica);
$verifica = mysqli_fetch_assoc($res_verifica);

if ($verifica['total'] == 0) {
    $query_m = "SELECT * FROM monstros";
    $res_m = mysqli_query($conexao, $query_m);
    while ($m = mysqli_fetch_assoc($res_m)) {
        $bloco = rand(1, 9);
        $x = rand(1, 20);
        $y = rand(1, 20);
        $sql_insert = "INSERT INTO monstros_sessao (ses_id, mon_id, ms_bloco, ms_x, ms_y) VALUES ({$player['pla_ses_id']}, {$m['mon_id']}, $bloco, $x, $y)";
        mysqli_query($conexao, $sql_insert);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movimento Mobile</title>
  <link rel="stylesheet" href="../../../css/game/movimento.css">
  <link rel="stylesheet" href="../../../css/general/fonts.css">
  <link rel="stylesheet" href="../../../css/game/elements/components.css">
  <link rel="stylesheet" href="../../../css/game/elements/animations.css">
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
    .monstro-icon {
      position: absolute;
      width: calc(350px/20 - 2px);
      height: calc(350px/20 - 2px);
      border-radius: 50%;
      background-color: #5e0000;
      box-shadow: 0 0 10px 4px red;
      z-index: 10;
    }
    .celula-perigo {
      box-shadow: inset 0 0 5px red;
    }
  </style>
</head>
<body>
  <div class="map-view">
    <div class="grid-centro" id="gridCentro">
      <?php
      $monstros_visiveis = [];
      $perigosas = [];
      $query_monstros = "SELECT ms.*, m.mon_nome FROM monstros_sessao ms JOIN monstros m ON ms.mon_id = m.mon_id WHERE ms.ses_id = {$player['pla_ses_id']}";
      $result_monstros = mysqli_query($conexao, $query_monstros);
      while ($row = mysqli_fetch_assoc($result_monstros)) {
          if ($row['ms_bloco'] == $player['pla_bloco']) {
              $dist = abs($player['pla_x'] - $row['ms_x']) + abs($player['pla_y'] - $row['ms_y']);
              if ($dist <= $raio) {
                  $monstros_visiveis[] = $row;
              }
          }
      }

      $alcancePerigo = 2;
      foreach ($monstros_visiveis as $monstro) {
          if ($monstro['ms_bloco'] == $player['pla_bloco']) {
              $mx = $monstro['ms_x'];
              $my = $monstro['ms_y'];
              for ($dx = -$alcancePerigo; $dx <= $alcancePerigo; $dx++) {
                  for ($dy = -$alcancePerigo; $dy <= $alcancePerigo; $dy++) {
                      if (abs($dx) + abs($dy) <= $alcancePerigo) {
                          $px = $mx + $dx;
                          $py = $my + $dy;
                          if ($px >= 1 && $px <= 20 && $py >= 1 && $py <= 20) {
                              $perigosas[] = [$px, $py];
                          }
                      }
                  }
              }
          }
      }

      for($b=1;$b<=9;$b++): ?>
        <div class="bloco-centro" data-bloco="<?=$b?>">
          <?php foreach ($companheiros as $c) {
            if ($c['pla_bloco'] != $b) continue;
            $cx = ($c['pla_x']-1)*(352/20);
            $cy = ($c['pla_y']-1)*(352/20);
            echo "<div class='player-icon' style='left:{$cx}px; top:{$cy}px; background-color:#999;'></div>";
          } ?>
          <?php foreach ($monstros_visiveis as $monstro) {
              if ($monstro['ms_bloco'] == $b) {
                  $mx = ($monstro['ms_x'] - 1) * (352 / 20);
                  $my = ($monstro['ms_y'] - 1) * (352 / 20);
                  echo "<div class='monstro-icon' style='left:{$mx}px; top:{$my}px;' title='{$monstro['mon_nome']}' data-x='{$monstro['ms_x']}' data-y='{$monstro['ms_y']}'></div>";
              }
          } ?>
          <div class="grid-celulas">
            <?php
            for($y=1;$y<=20;$y++){
              for($x=1;$x<=20;$x++){
                $classe = '';
                if($b == $player['pla_bloco']){
                  $dist = abs($player['pla_x'] - $x) + abs($player['pla_y'] - $y);
                  if($dist <= $raio && $eh_turno) $classe = ' celula-movimento';
                  foreach ($perigosas as $p) {
                    if ($p[0] == $x && $p[1] == $y) {
                      $classe .= ' celula-perigo';
                      break;
                    }
                  }
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
  <a href="playerIndex.php" class="voltar subtitle">Voltar</a>
</body>
<?php if (!$eh_turno): ?>
<div style="position: fixed; top: 10px; left: 50%; transform: translateX(-50%); background: #f8d7da; color: #721c24; padding: 10px 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.2); z-index: 999;">
  ⏳ Aguarde sua vez...
</div>
<?php endif; ?>
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
  const monstros = Array.from(document.querySelectorAll('.monstro-icon')).map(m => ({
    x: parseInt(m.dataset.x),
    y: parseInt(m.dataset.y),
    bloco: parseInt(m.parentElement.parentElement.dataset.bloco)
  }));

  document.querySelectorAll('.celula-movimento').forEach(celula => {
    celula.addEventListener('click', async (e) => {
      if (!ehTurno) {
        alert("Aguarde sua vez.");
        return;
      }
      if (celula.classList.contains('celula-bloqueada')) return;
      const bloco = parseInt(e.target.dataset.bloco);
      const y = parseInt(e.target.dataset.linha);
      const x = parseInt(e.target.dataset.coluna);
      const monstro = monstros.find(m => m.bloco === bloco && (Math.abs(m.x - x) + Math.abs(m.y - y)) <= 1);
      let confirmar = true;
      if (celula.classList.contains('celula-perigo')) {
        confirmar = confirm("⚔️ Você entrará em combate! Deseja continuar?");
        if (confirmar) {
          window.location.href = `combate.php?x=${x}&y=${y}&bloco=${bloco}`;
        }
      }else {
        confirmar = confirm(`Mover para linha ${y}, coluna ${x}?`);
      }
      if (confirmar) {
        try {
          const response = await fetch('atualiza_movimento.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: `bloco=${bloco}&x=${x}&y=${y}`
          });
          const result = await response.text();
          if (result.trim() === 'ok') {
            if (monstro) {
              window.location.href = `iniciar_combate.php?x=${x}&y=${y}&bloco=${bloco}`;
            } else {
              location.reload();
            }
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

<script>
  setInterval(async () => {
    try {
      const response = await fetch('verifica_turno.php');
      const result = await response.json();
      if (result.status === 'ok' && result.eh_turno) {
        location.reload();
      }
    } catch (e) {
      console.warn('Erro ao verificar turno:', e);
    }
  }, 10000);
</script>
