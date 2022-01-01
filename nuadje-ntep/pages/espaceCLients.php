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
    <link rel="stylesheet" href="../css/espaceClients.css">
    <script type="text/javascript" src="../js/espaceClients.js"></script>
    <title>Espace Clients</title>
</head>
<body>
    <div id="contain">
        <!--en-tête-->
            <?php
                require_once("../include/head.php");
            ?>
        <!--/en-tête-->

        <section>
            <div id="client">
                <h1 id="h1">Bienvenue Mme / M. <?php echo $_SESSION['Nom']; ?> dans votre espace client</h1>

                <div id="action">
                    <p>Vous pouvez</p>
                        <p class="a"><img src="../img/avatar.png" alt="icone_profil"><a href="updateInfos.php">Changer vos informations personnelles</a></p>
                        <p class="a"><img src="../img/images (1).jpg" alt="icone_livre"><a href="getLivres.php">Visualiser la librairie</a></p>
                        <p class="a"><img src="../img/shopping-cart.png" alt="icone_panier"><a href="getHistorique.php">Visualiser l'historique des vos achats</a></p>
                </div>
            </div>

            <!--<a href="javascript:ouvre_popup('popup.php')">Ouverture d'un popup</a>-->
            <?php
                if(isset($_GET['changement']))
                {
            ?>
                <div id="popup">
                    <h1>Voici votre nouveau Profil</h1>
                    <hr>
                    <a href="javascript:fermer();" class="close">&times;</a>

                    <p>Nom : <?php echo $_SESSION['Nom']; ?> </p>
                    <p>Prenom : <?php echo $_SESSION['Prenom']; ?> </p>
                    <p>Email : <?php echo $_SESSION['Email']; ?> </p>
                    <p>Password : <?php echo $_SESSION['Password']; ?> </p>
                    <p>Adresse : <?php echo $_SESSION['Adresse']; ?> </p>
                    <p>Adresse de Livraison : <?php echo $_SESSION['AdresseLivraison']; ?> </p>

                    <button class="button" onclick="fermer();">OK</button>
                </div>
            <?php
                }
            ?>

            <aside>
                <p class="profil"><img src="../img/connect.png" class="compte" alt="icone_profil"></p>
                <h1>Mon Compte</h1>
                <hr>
                <p>Nom : <?php echo $_SESSION['Nom']; ?> </p>
                <p>Prenom : <?php echo $_SESSION['Prenom']; ?> </p>
                <p>Email : <?php echo $_SESSION['Email']; ?> </p>
                <p>Password : <?php echo $_SESSION['Password']; ?> </p>
                <p>Adresse : <?php echo $_SESSION['Adresse']; ?> </p>
                <p>Adresse de Livraison : <?php echo $_SESSION['AdresseLivraison']; ?> </p>

                <div class="lien">
                    <p style="margin-bottom:3px;"><a href="deconnexion.php" id="disconnect" title="se déconnecter"> Se déconnecter</a></p>
                    <p><a href="drop.php" id="suppression" title="supprimer mon compte"> Supprimer mon compte</a></p>
                </div>
            </aside>
            
        </section>

        <!--footer--->
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
        header('location: ../index.php');
    }
?>