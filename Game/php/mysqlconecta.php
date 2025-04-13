<?php
//Em produção   $servidor = "mysql.railway.internal:3306";
$servidor = "hopper.proxy.rlwy.net:29888";
$usuario = "root";
$senha = "WNogfHzeWRCTciZYPWXhLdPpsJNDfNiu";
$bancodados = "railway";

$conexao = mysqli_connect($servidor, $usuario, $senha, $bancodados) or die("Problemas ao conectar ao banco!");

?>