<?php
$servidor = "mysql.railway.internal:3306";
$usuario = "root";
$senha = "WNogfHzeWRCTciZYPWXhLdPpsJNDfNiu";
$bancodados = "railway";

$conexao = mysqli_connect($servidor, $usuario, $senha, $bancodados) or die("Problemas ao conectar ao banco!");

?>