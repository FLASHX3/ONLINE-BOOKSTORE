<?php
    if(!isset($_POST['envoie']) AND !isset($_SESSION['Id']))
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/nouveauClient.css">
    <link rel="stylesheet" href="../css/include.css">
    <script type="text/javascript" src="../js/nouveauClient.js"></script>
    <title>INSCRIVEZ-VOUS 😁</title>
</head>
<body>
    <div id="contain">
        <!--en-tête-->
        <?php
            include_once("../include/head.php");
        ?>
        <!--/en-tête-->

        <section>
            <form action="nouveauClient.php" method="post" onsubmit="return verifForm(this);">
                <fieldset>
                    <h1>Création d'un nouvel adhérent</h1>
                    <table>
                        <tr>
                            <td class="label"><label for="nom">Nom</label></td> <td><input type="text" required id="nom" name="nom" placeholder="enter your name" onblur="verifNom(this);" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td class="span" colspan="2" id="errnom"><?php if(isset($_GET['errnom'])){echo $_GET['errnom'];} ?></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="prenom">Prénom</label></td> <td><input type="text" required id="prenom" name="prenom" placeholder="enter your surname" autocomplete="off" onblur="verifPrenom(this);"></td>
                        </tr>
                        <tr>
                            <td class="span" colspan="2" id="errprenom"><?php if(isset($_GET['errprenom'])){echo $_GET['errprenom'];} ?></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="email">Email</label></td> <td><input type="email" required id="email" name="email" placeholder="enter your email" autocomplete="off" onblur="verifEmail(this);"></td>
                        </tr>
                        <tr>
                            <td class="span" colspan="2" id="erremail"><?php if(isset($_GET['erremail'])){echo $_GET['erremail'];} ?></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="password">Password</label></td> <td><input type="password" required id="password" name="password" placeholder="8 caratères minimum, 16 caractères maximum" maxlength="16" autocomplete="off" onblur="verifPassword(this);"></td>
                        </tr>
                        <tr>
                            <td class="span" colspan="2" id="errpass"><?php if(isset($_GET['errpass'])){echo $_GET['errpass'];} ?></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="cpassword">Confirmer password</label></td> <td><input type="password" required id="cpassword" name="cpassword" placeholder="re-enter your password" maxlength="16" autocomplete="off" onblur="verifConfPassword(this);"></td>
                        </tr>
                        <tr>
                            <td class="span" colspan="2" id="errcpass"><?php if(isset($_GET['errcpass'])){echo $_GET['errcpass'];} ?></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="adresse">Adresse</label></td> <td><input type="tel" required id="adresse" name="adresse" placeholder="enter your phone number" autocomplete="off" onblur="verifAdresse(this);"></td>
                        </tr>
                        <tr>
                            <td class="span" colspan="2" id="erradr"><?php if(isset($_GET['erradr'])){echo $_GET['erradr'];} ?></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="adrLivr">Adresse de livraison</label></td> <td><input type="text" required id="adrLivr" name="adrLivr" placeholder="enter your location" autocomplete="off" onblur="verifAdrLivr(this);"></td>
                        </tr>
                        <tr>
                            <td class="span" colspan="2" id="erradrlivr"><?php if(isset($_GET['erradrlivr'])){echo $_GET['erradrlivr'];} ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Validez" name="envoie"> <input type="reset" value="Effacer"></td>
                        </tr>
                        
                    </table>
                </fieldset>
            </form>
            <a href="../index.php" id="goback" title="aller sur la page de connexion">J'ai déjà un compte / me connecter</a>
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
    else if(isset($_POST['envoie']))
    {
        #on annule et on supprime les caractères html qui aurait pu être ajouter par le client
        $nom=strip_tags(htmlspecialchars($_POST['nom']));
        $prenom=strip_tags(htmlspecialchars($_POST['prenom']));
        $email=strip_tags(htmlspecialchars($_POST['email']));
        $password=strip_tags(htmlspecialchars($_POST['password']));
        $cpassword=strip_tags(htmlspecialchars($_POST['cpassword']));
        $tel=strip_tags(htmlspecialchars($_POST['adresse']));
        $adrLivr=strip_tags(htmlspecialchars($_POST['adrLivr']));

        #on verifie les champs avec les expressions régulières de chaque champ
        if(!preg_match("#^[a-zA-Zéèêâôï -]{0,25}$#",$nom))
        {
            header('location: nouveauClient.php?errnom=nom invalide!');
        }
        if(!preg_match("#^[a-zA-Zéèêâôï -]{0,25}$#",$prenom))
        {
            header('location: nouveauClient.php?errprenom=prenom invalide!');
        }
        if(!preg_match("#^[a-zA-Z0-9]+@[a-zA-Z0-9_-]+\.[a-z]{2,4}$#",$email))
        {
            header('location: nouveauClient.php?erremail=email invalide!');
        }
        if(!preg_match("#^[a-zA-Z0-9éèôâêîï.-_*@&$]{8,16}$#",$password))
        {
            header('location: nouveauClient.php?errpass=password invalide!');
        }
        if(!preg_match("#^[a-zA-Z0-9éèôâêîï.-_*@&$]{8,16}$#",$cpassword))
        {
            header('location: nouveauClient.php?errcpass=password invalide!');
        }
        if(!preg_match("#^6([-. ]?[0-9]{2}){4}$#",$tel))
        {
            header('location: nouveauClient.php?erradr=adresse invalide!');
        }
        if(!preg_match("#^[a-zA-Z0-9éèêâôïç -]{1,38}$#",$adrLivr))
        {
            header('location: nouveauClient.php?erradrlivr=adresse de livraison invalide!');
        }

        if($password===$cpassword)
        {
            #on hache le mot de passe
            $hash = sha1($password);
        }
        else
        {
            header('location: nouveauClient.php?errpass=les mots de passe ne sont pas identiques!');
        }

        try
        {
            $bdd = new PDO("mysql:host=localhost;dbname=librairie;charset=utf8",'root','');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $verification=$bdd->prepare("SELECT * FROM clients WHERE Email=?");
            $verification->execute(array($email));
            $userexist=$verification->rowCount();

            #on verifie si l'email envoyé est déjà utilisé si non on crée son compte
            if($userexist==0)
            {
                $verification->closeCursor();
                $insertion=$bdd->prepare("INSERT INTO  clients VALUES('',?,?,?,?,?,?,NOW(),0)");
                $insertion->execute(array($nom,$prenom,$email,$hash,$tel,$adrLivr));
                $insertion->closeCursor();

                #on recupère les infos qu'on vient d'inscrire dans la bd

                $requete= $bdd->prepare("SELECT * FROM clients WHERE Email=?");
                $requete->execute(array($email));
                $userinfo=$requete->fetch();

                session_start();
                $_SESSION['Id']=$userinfo['Id'];
                $_SESSION['Nom']=$userinfo['Nom'];
                $_SESSION['Prenom']=$userinfo['Prenom'];
                $_SESSION['Email']=$userinfo['Email'];
                $_SESSION['Password']=$password;
                $_SESSION['Adresse']=$userinfo['Adresse'];
                $_SESSION['AdresseLivraison']=$userinfo['AdresseLivraison'];
                $_SESSION['DateCreationCompte']=$userinfo['DateCreationCompte'];
                $_SESSION['NombreAchat']=$userinfo['NombreAchat'];
                $requete->closeCursor();
                header("location: espaceCLients.php");
            }
            else
            {
                $verification->closeCursor();
                header('location: nouveauClient.php?erremail=cet email est déjà utilisé');
            }
        }
        catch(PDOException $e)
        {
            die('Erreur: '.$e->getMessage());
        }
    }
    else{
        header('location: ../index.php');
    }
?>