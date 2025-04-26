<?php

    $dialogo = isset($_GET['dialogo']) ? $_GET['dialogo'] : 'intro';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The King's Will</title>
    <link rel="stylesheet" href="../../../css/game/settings.css">
    <link rel="stylesheet" href="../../../css/game/elements/components.css">
    <link rel="stylesheet" href="../../../css/game/elements/animations.css">

</head>
<body>
    
    

    <div class="transition"></div>
    
        <div class="container-dialogo">

            <div class="text-box fade-in">

                <div class="container-personagem">

                    <img src="" alt="personagem">
                    <h1></h1>

                </div>

                <p></p>

            </div>

        </div>

    </div>

</body>
</html>

<script>
        const nomeDoDialogo = "<?php echo $dialogo; ?>";
</script>
<script src="../../../js/game/jogabilidade/chats.js"></script>