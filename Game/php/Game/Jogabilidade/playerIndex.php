<?php

    session_start();

    if (isset($_SESSION['classe']) && isset($_SESSION['nome']) && isset($_SESSION['reino'])) {
        

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Cadastro de Player</title>
    <link rel="stylesheet" href="../../../css/game/mobile.css">
    <link rel="stylesheet" href="../../../css/general/fonts.css">
    <link rel="stylesheet" href="../../../css/general/attributes.css">
</head>
<body>
    
    <div class="container-personagem">

        <div class="img"><?php echo $_SESSION['classe'] ?></div>

        <p class="subtitle bold mediumT"><?php echo $_SESSION['nome'] ?></p>

        <p class="subtitle bold">Prisioneiro do reino <?php echo $_SESSION['reino'] ?></p>  

    </div>

</body>

<?php }else{

        header("Location: ../cadastro.php");

} ?>