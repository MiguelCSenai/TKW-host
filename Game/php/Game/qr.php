<?php
require __DIR__ . '/vendor/autoload.php';
include "../mysqlconecta.php";

use Endroid\QrCode\Builder\Builder;

header('Content-Type: image/png');

mysqli_query($conexao, "INSERT INTO sessoes () VALUES ();");

$ses_id = mysqli_insert_id($conexao);

echo Builder::create()
    ->data("https://thekingswill.up.railway.app/Game/php/Game/cadastro.php?ses_id={$ses_id}")
    ->size(300)
    ->margin(10)
    ->build()
    ->getString();
?>
