<?php
require __DIR__ . '/vendor/autoload.php';

use Endroid\QrCode\Builder\Builder;

header('Content-Type: image/png');

echo Builder::create()
    ->data('https://thekingswill.up.railway.app/Game/php/Game/cadastro.php')
    ->size(300)
    ->margin(10)
    ->build()
    ->getString();
