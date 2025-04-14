<?php
session_start();

require __DIR__ . '/vendor/autoload.php';
include "../mysqlconecta.php";

use Endroid\QrCode\Builder\Builder;

header('Content-Type: image/png');

if (!isset($_SESSION['ses_id'])) {
    mysqli_query($conexao, "INSERT INTO sessoes () VALUES ();");
    $ses_id = mysqli_insert_id($conexao);
    $_SESSION['ses_id'] = $ses_id;
} else {
    $ses_id = $_SESSION['ses_id'];
}

echo Builder::create()
    ->data("https://thekingswill.up.railway.app/Game/php/Game/cadastro.php?ses_id={$ses_id}")
    ->size(300)
    ->margin(10)
    ->build()
    ->getString();
?>
