<?php
session_start();
include "../../mysqlconecta.php";

$x = $_GET['x'];
$y = $_GET['y'];
$bloco = $_GET['bloco'];
$ses_id = $_SESSION['ses_id'];

$query = "SELECT ms.*, m.mon_nome FROM monstros_sessao ms
          JOIN monstros m ON ms.mon_id = m.mon_id
          WHERE ms_bloco = $bloco AND ses_id = $ses_id 
          AND ABS(ms_x - $x) + ABS(ms_y - $y) <= 1";

$result = mysqli_query($conexao, $query);
$monstro = mysqli_fetch_assoc($result);

if ($monstro) {?>

    <div class="container">

        <div class="container-inimigo"></div>

        

    </div>
    
<?php } else {
    header("Location: movimento.php");
}
?>
