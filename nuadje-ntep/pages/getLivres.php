<?php
    session_start();
    if(isset($_SESSION['Id']))
    {
        try
        {
            $bdd= new PDO("mysql:host=localhost;dbname=librairie;charset=utf8",'root','');
            $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        }
        catch(PDOException $e)
        {
            die("Erreur: ".$e->getMessage());
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/getLivres.css">
    <link rel="stylesheet" href="../css/include.css">
    <script type="text/javascript" src="../js/getLivres.js"></script>
    <title>Librairie</title>
</head>
<body>
    <div id="contain">
        <!--en-tête-->
            <?php
                require_once("../include/head.php");
            ?>
        <!--/en-tête-->

        <section>
            <h1><img src="../img/images (1).jpg" alt="icone_livre"> Listes des livres disponibles à l'achat</h1>
            
            <marquee scrollamount="5">
                <?php
                    for($i=1; $i<=48; $i++)
                    {
                        echo "<img src='../img/$i.jpg' alt='image de livre' class='livre'/>";
                    }
                ?>
            </marquee>
            
            <table border="1">
                <tr>
                    <th>Isbn</th><th>Titre</th><th>Auteur</th><th>Date parutoin</th><th>Prix</th><th>Acheter</th>
                </tr>
                
                <?php
                    $requete=$bdd->prepare("SELECT `Isbn`, `Titre`, `Auteur`, DATE_FORMAT(DateParution, '%d/%m/%Y') AS date, `Prix` FROM `articles` ");
                    $requete->execute();
                    while($resultat=$requete->fetch())
                    {
                ?>

                <tr class="tr">
                    <td><?php echo $resultat['Isbn']; ?></td>
                    <td><?php echo $resultat['Titre']; ?></td>
                    <td><?php echo $resultat['Auteur']; ?></td>
                    <td><?php echo $resultat['date']; ?></td>
                    <td><?php echo $resultat['Prix']; ?>Frs</td>
                    <td><a href="Achat.php?Isbn=<?php echo $resultat['Isbn']; ?>&Titre=<?php echo $resultat['Titre']; ?>&Auteur=<?php echo $resultat['Auteur']; ?>&DateParution=<?php echo $resultat['date']; ?>&Prix=<?php echo $resultat['Prix']; ?>">Acheter</a></td>
                </tr>

                <?php
                    }
                    $requete->closeCursor();
                ?>
            </table>
        <a href="espaceCLients.php" id="retour" title="revenez sur votre espace client">retourner vers votre escape client</a>
        </section>

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
        header('location: ../index.php');
    }
?>