<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/error.css">
    <link rel="stylesheet" href="../css/include.css">
    <title>ERROR ☹</title>
</head>
<body>
    <div id="contain">

        <?php
            include_once("../include/head.php");
        ?>
    
        <div id="message">
            <p>Votre login et/ou votre mot de passe sont incorrects.</p>
            <p><a href="../index.php" title="cliquez pour revenir à l'accueil">Retournez à la page d'accueil</a></p>
        </div>

        <?php
            include_once("../include/footer.php");
        ?>
    </div>
</body>
</html>