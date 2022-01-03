<?php
    if(!isset($_SESSION['Id']))
    {       # le formulaire n'a pas encore été envoyé
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/mail.css">
    <link rel="stylesheet" href="../css/include.css">
    <script src="../js/mail.js"></script>
    <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon">
    <title>Récupération de mot de passe</title>
</head>
<body>
    <div id=""contain>
        <!--en-tête-->
        <?php
            include_once("../include/head.php");
        ?>
        <!--/en-tête-->

        <section>

        </section>

        <!--footer-->
        <?php
            include_once("../include/footer.php");
        ?>
        <!--/footer-->
    </div>
</body>
</html>

<?php
    }
    else
    {
        header('location: ..index.php');
    }
?>