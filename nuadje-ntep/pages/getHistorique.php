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
    <link rel="stylesheet" href="../css/getHistorique.css">
    <script type="text/javascript" src="../js/getHistorique.js"></script>
    <title>Historique des achats</title>
</head>
<body>
    <div id="contain">
        <!--en-tête-->
        <?php
                require_once('../include/head.php');
            ?>
        <!--/en-tête-->

        <section>
            <div id="historique">
                <h1>Voici l'historique de vos achats</h1>
                
                <table border="1">
                    <tr>
                        <th>Isbn</th><th>Titre</th><th>Auteur</th><th>Date de Parution</th><th>Prix</th><th>Date achat</th>
                    </tr>
                    <?php
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
                        
                        $requete=$bdd->prepare("
                        SELECT Ar.Isbn as isbn, Ar.Titre as titre, Ar.Auteur as auteur, Ar.Prix as prix, DATE_FORMAT(Ar.DateParution, '%d/%m/%Y') as dateP, DATE_FORMAT(Pa.DateAchat, '%d/%m/%Y') as dateA, Pa.IdClient as idclient
                        FROM articles Ar
                        INNER JOIN panier Pa
                        ON Ar.Isbn=Pa.IsbnLivre
                        ");
                        $requete->execute();
                        $nb=$requete->rowCount();  #on récupère son nombre d'achat

                        if($nb>0)
                        {
                        $count=0;

                            while($resultat=$requete->fetch())
                            {
                                if($_SESSION['Id']==$resultat['idclient'])
                                {
                                    $count++;
                                    if($count==6){$resultat['prix']=$resultat['prix']-0.05*$resultat['prix'];}
                    ?>
                    <tr class="tr">
                        <td><?php echo $resultat['isbn']; ?></td>
                        <td><?php echo $resultat['titre']; ?></td>
                        <td><?php echo $resultat['auteur']; ?></td>
                        <td><?php echo $resultat['dateP']; ?></td>
                        <td><?php echo $resultat['prix']; ?>Frs</td>
                        <td><?php echo $resultat['dateA']; ?></td>
                    </tr>
                    <?php
                                }
                            }
                            $requete->closeCursor();
                        }
                        else{
                            echo '<tr class="tr"><td colspan="6">Aucun achat n\'a été éffectuer</td></tr>';
                        }
                    ?>
                </table>
                <a href="espaceCLients.php" id="retour" title="revenez sur votre espace client">retourner vers votre escape client</a>
            </div>
        </section>

        <!--footer-->
            <?php
                require_once('../include/footer.php');
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