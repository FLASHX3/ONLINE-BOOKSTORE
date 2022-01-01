<?php
    session_start();
    if(!isset($_POST['envoie']) AND isset($_SESSION['Id']))
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/updateInfos.css">
    <link rel="stylesheet" href="../css/include.css">
    <script type="text/javascript" src="../js/updateInfos.js"></script>
    <title>Mise à jour</title>
</head>
<body>
<div id="contain">
        <!--en-tête-->
            <?php
                require_once("../include/head.php");
            ?>
        <!--/en-tête-->

        <section>
            <form action="updateInfos.php" method="post" onsubmit="return verifForm(this);">
                <h1><img src="../img/avatar.png" alt="icone-profil"> Modification des informations personnelles</h1>
                <hr><br>

                <table>
                    <tr>
                        <td class="label"><label for="adresse">Adresse</label></td> <td class="champ"><input type="tel" name="adresse" id="adresse" placeholder="modifier votre numéro de téléphone" onblur="verifTel(this);"></td>
                    </tr>
                    <tr>
                        <td class="champ" colspan="2" id="errtel"><?php if(isset($_GET['erradr'])){echo $_GET['erradr'];} ?></td>
                    </tr>
                    <tr>
                        <td class="label"><label for="adrlivr">Adresse de Livraison</label></td> <td class="champ"><input type="text" name="adrlivr" id="adrlivr" placeholder="modifier l'adresse de livraison" onblur="verifAdrLivr(this);"> </td>
                    </tr>
                    <tr>
                        <td class="champ" colspan="2" id="errville"><?php if(isset($_GET['erradrlivr'])){echo $_GET['erradrlivr'];} ?></td>
                    </tr>
                    <tr>
                        <td class="label"><label for="password">Ancien mot de passe</label></td> <td class="champ"><input type="password" name="password" id="password" maxlength="16" placeholder="votre ancien mot de passe" onblur="verifPassword(this);"></td>
                    </tr>
                    <tr>
                        <td class="champ" colspan="2" id="errpass"><?php if(isset($_GET['errpassword'])){echo $_GET['errpassword'];} ?></td>
                    </tr>
                    <tr>
                        <td class="label"><label for="newpassword">Nouveau mot de passe</label></td> <td class="champ"><input type="password" name="newpassword" id="newpassword" maxlength="16" placeholder="Entrez votre nouveau mot de passe" onblur="verifPassword(this,1);"> </td>
                    </tr>
                    <tr>
                        <td class="champ" colspan="2" id="errnewpass"><?php if(isset($_GET['errnewpassword'])){echo $_GET['errnewpassword'];} ?></td>
                    </tr>
                    <tr>
                        <td class="label"><label for="confpassword">Confirmer Nouveau mot de passe</label></td> <td class="champ"><input type="password" name="confpassword" id="confpassword" maxlength="16" placeholder="Confirmer le nouveau mot de passe" onblur="confirmPassword(this);"></td>
                    </tr>
                    <tr>
                        <td class="champ" colspan="2" id="errcpass"><?php if(isset($_GET['errcpassword'])){echo $_GET['errcpassword'];} ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Valider" name="envoie"> <input type="reset" value="Effacer"></td>
                    </tr>
                </table>
            </form>
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
    else if(isset($_POST['envoie']) AND isset($_SESSION['Id']))
    {
        if(isset($_POST['adresse']) || isset($_POST['adrlivr']) || (isset($_POST['password']) && isset($_POST['newpassord']) && isset($_POST['confpassword'])))
        {
            try
            {
                $bdd= new PDO("mysql:host=localhost;dbname=librairie;charset=utf8",'root','');
                $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
            }
            catch(PDOException $e)
            {
                die('Erreur: '.$e->getMessage());
            }

            #s'il veut changer son adresse
            if(isset($_POST['adresse']) AND !empty($_POST['adresse']))
            {
                $adresse=strip_tags(htmlspecialchars($_POST['adresse']));
                if(!preg_match('#^6([-. ]?[0-9]{2}){4}$#',$adresse))
                {
                    header('location: updateInfos.php?erradr=le numéro doit commencer par 6 et contient 9 chiffres!');
                }
                if($adresse!=$_SESSION['Adresse'])
                {
                    $requete=$bdd->prepare("UPDATE clients SET Adresse=? WHERE Id=?");
                    $requete->execute(array($adresse,$_SESSION['Id']));
                    $requete->closeCursor();

                    $_SESSION['Adresse']=$adresse;
                    $a=true;
                }
                else
                {
                    header('location: updateInfos.php?erradr=vous avez saisie la même adresse!');
                }
            }

            #s'il veut changer son adresse de livraison
            if(!empty($_POST['adrlivr']) AND isset($_POST['adrlivr']))
            {
                $adrlivr=strip_tags(htmlspecialchars($_POST['adrlivr']));
                if(!preg_match('#^[a-zA-Z0-9éèêâôïç -]{1,38}$#',$adrlivr))
                {
                    header('location: updateInfos.php?erradrlivr=adresse de livraison invalide!');
                }
                if($adrlivr!=$_SESSION['AdresseLivraison'])
                {
                    $requete=$bdd->prepare("UPDATE clients SET AdresseLivraison=? WHERE Id=?");
                    $requete->execute(array($adrlivr,$_SESSION['Id']));
                    $requete->closeCursor();

                    $_SESSION['AdresseLivraison']=$adrlivr;
                    $b=true;
                }
                else
                {
                    header('location: updateInfos.php?erradrlivr=vous avez saisie la même adresse de livraison!');
                }
            }

            #s'il veut changer son mot de passe
            if(isset($_POST['password']) AND isset($_POST['confpassword']) AND $_POST['newpassword'])
            {
                $password=strip_tags(htmlspecialchars($_POST['password']));
                $cpassword=strip_tags(htmlspecialchars($_POST['confpassword']));
                $newpassword=strip_tags(htmlspecialchars($_POST['newpassword']));

                if(!preg_match('#^[a-zA-Z0-9éèôâêîï.-_*@&$]{8,16}$#',$password))
                {
                    header('location: updateInfos.php?errpassword=mot de passe incorrecte!');
                }
                if(!preg_match('#^[a-zA-Z0-9éèôâêîï.-_*@&$]{8,16}$#',$cpassword))
                {
                    header('location: updateInfos.php?errcpassword=mot de passe incorrecte!');
                }
                if(!preg_match('#^[a-zA-Z0-9éèôâêîï.-_*@&$]{8,16}$#',$newpassword))
                {
                    header('location: updateInfos.php?errnewpassword=mot de passe incorrecte!');
                }

                #on verifie si l'ancien mot de passe correspond
                if($password==$_SESSION['Password'])
                {
                    if($cpassword==$newpassword)
                    {
                        $hash=sha1($newpassword);
                        $update=$bdd->prepare("UPDATE clients SET Password=? WHERE Id=?");
                        $update->execute(array($hash,$_SESSION['Id']));
                        $update->closeCursor();

                        $_SESSION['Password']=$newpassword;
                        $c=true;
                    }
                    else
                    {
                        header('location: updateInfos.php?errnewpassword=les nouveaux mot de passe saisie n\'est pas identiques');
                    }
                }
                else
                {
                    header('location: updateInfos.php?errpassword=l\'ancien mot de passe ne correspond pas!');
                }
            }
            else if(isset($_POST['password']) AND (!isset($_POST['newpassword']) || !isset($_POST['confpassword'])) || (empty($_POST['newpassword'] || empty($_POST['confpassword']))))
            {
                header('location: updateInfos.php?errpassword=remplissez et confirmez le nouveau mot de passe!');
            }
            else
            {
                header('location: updateInfos.php?errpassword=remplissez plus d\'informations pour changer de mot de passe');
            }

            if($a || $b || $c)
            {
                header('location: espaceCLients.php?changement=true');
            }
        }
        else
        {
            header('location: updateInfos.php');
        }
    }
    else
    {
        header('location: ../index.php');
    }
?>