<?php
    session_start();
    if(isset($_SESSION['Id']))
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/include.css">
    <link rel="stylesheet" href="../css/espaceClient.css">
    <title>espaceClients</title>
</head>
<body>
    <div id="contain">
        <?php
            require_once("../include/head.php");
        ?>

        <div id="client">
            <h1>Bienvenue Mme / M. <?php echo $_SESSION['Nom']; ?> dans votre espace client</h1>
            <p>Vous pouvez</p>
            <ul>
                <li><a href="updateInfos.php">Changer vos informations personnelles</a></li>
                <li><a href="getLivres.php">Visualiser la librairie</a></li>
                <li><a href="getHistorique.php">Visualiser l'historique des vos achats</a></li>
            </ul>
        </div>

        <?php
            require_once("../include/footer.php");
        ?>
    </div>
</body>
</html>

<?php
    }
    else
    {

    }
?>