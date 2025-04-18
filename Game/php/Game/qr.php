<?php
session_start();
$limite = $_SESSION['play_num'];
include "../mysqlconecta.php";

require __DIR__ . '/vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;

header('Content-Type: image/png');

$ses_id = $_SESSION['ses_id'];

echo Builder::create()
    ->data("https://thekingswill.up.railway.app/Game/php/Game/cadastro.php?ses_id={$ses_id}")
    ->size(300)
    ->margin(10)
    ->build()
    ->getString();
?>
