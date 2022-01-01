<?php
    session_start();
    if(isset($_SESSION['Id']) AND isset($_GET['Isbn']) AND isset($_GET['Titre']) AND isset($_GET['Auteur']) AND isset($_GET['DateParution']) AND isset($_GET['Prix']))
    {
        try
        {
            $bdd= new PDO("mysql:host=localhost;dbname=librairie;charset=utf8",'root','');
            $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

            #on ajoute le nouvel achat dans le panier
            $requete=$bdd->prepare("INSERT INTO panier VALUES(?,?,NOW())");
            $requete->execute(array($_SESSION['Id'],$_GET['Isbn']));
            $requete->closeCursor();

            #on recupère le nombreAchat du client pour pouvoir l'incrémenter après
            $select=$bdd->prepare("SELECT NombreAchat FROM clients WHERE Id=?");
            $select->execute(array($_SESSION['Id']));
            $donnee=$select->fetch();

            if($donnee['NombreAchat']==5)
            {
                $prix=$_GET['Prix']-0.05*$_GET['Prix'];
                $reduction=true;
            }
            else
            {
                $prix=$_GET['Prix'];
            }

            #on incrémente le nombreAchat
            $req=$bdd->prepare("UPDATE clients SET NombreAchat=? WHERE Id=?");
            $req->execute(array($donnee['NombreAchat']+1,$_SESSION['Id']));
            $req->closeCursor();
            $select->closeCursor();
        }
        catch(PDOException $e)
        {
            die('Erreur: '.$e->getMessage());
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/include.css">
    <link rel="stylesheet" href="../css/achat.css">
    <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon">
    <script type="text/javascript" src="../js/achat.js"></script>
    <title>Achat</title>
</head>
<body>
    <div id="contain">
        <!--en-tête-->
        <?php
            require_once("../include/head.php");
        ?>
        <!--/en-tête-->

        <section>
            <div id="recu">
                <h1>Nous vous remercions de votre achat</h1>
                <h2>Voici le récapitulatif</h2>

                <p>Titre : <?php echo $_GET['Titre']; ?> </p>
                <p>Isbn : <?php echo $_GET['Isbn']; ?> </p>
                <p>Auteur : <?php echo $_GET['Auteur']; ?></p>
                <p>Date de parution : <?php echo $_GET['DateParution']; ?> </p>
                <p>Prix : <?php echo $prix; ?>Frs </p>
            </div>
            <a href="espaceCLients.php" id="retour" title="revenez sur votre espace client">retourner vers votre escape client</a>
        </section>

        <?php
            if(isset($reduction))
            {
        ?>
            <div id="reduction">
            <h1>Bon de reduction</h1>
            <p>Chère client pour votre 6ième achat, vous beficier d'une réduction de 5% 😁</p>
            <p>Le montant de l'achat passe de <del><?php echo $_GET['Prix'];?>Frs</del> à <?php echo $prix; ?>Frs</p>
            <p>Online-bookstore vous remercie pour votre fidélité 😉</p>
            <button onclick="fermer();">OK</button>
        </div>
        <?php
            }
        ?>

        <!--footer-->
            <?php
                require_once("../include/footer.php");
            ?>
        <!--/footer-->
    </div>
</body>
</html>

<?php
    }
    else
    {
        header('header: ../index.php');
    }
?>