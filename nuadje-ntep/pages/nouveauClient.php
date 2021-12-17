<?php
    if(!isset($_POST['nom']))
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
                            <td class="label"><label for="nom">Nom</label></td> <td><input type="text" required id="nom" name="nom" placeholder="enter your name" oninput="verifNom(this);" autocomplete="off"><span>jjj</span></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="prenom">Prénom</label></td> <td><input type="text" required id="prenom" name="prenom" placeholder="enter your surname" autocomplete="off" oninput="verifPrenom(this);"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="email">Email</label></td> <td><input type="email" required id="email" name="email" placeholder="enter your email" autocomplete="off" oninput="verifEmail(this);"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="password">Password</label></td> <td><input type="password" required id="password" name="password" placeholder="8 caratères minimum, 16 caractères maximum" maxlength="16" autocomplete="off" oninput="verifPassword(this);"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="cpassword">Confirmer password</label></td> <td><input type="password" required id="cpassword" name="cpassword" placeholder="re-enter your password" maxlength="16" autocomplete="off" oninput="verifConfPassword(this);"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="adresse">Adresse</label></td> <td><input type="tel" required id="adresse" name="adresse" placeholder="enter your phone number" autocomplete="off" oninput="verifAdresse(this);"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="adrLivr">Adresse de livraison</label></td> <td><input type="text" required id="adrLivr" name="adrLivr" placeholder="enter your location" autocomplete="off" oninput="verifAdrLivr(this);"></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="submit" value="Validez"> <input type="reset" value="Effacer"></td>
                        </tr>
                    </table>
                </fieldset>
            </form>
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
    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['cpassword']) && isset($_POST['adresse']) && isset($_POST['adrLivr']))
    {
        #on annule et on supprime les caractères html qui aurait pu être ajouter

        $nom=strip_tags(htmlspecialchars($_POST['nom']));
        $prenom=strip_tags(htmlspecialchars($_POST['prenom']));
        $email=strip_tags(htmlspecialchars($_POST['email']));
        $password=strip_tags(htmlspecialchars($_POST['password']));
        $cpassword=strip_tags(htmlspecialchars($_POST['cpassword']));
        $tel=strip_tags(htmlspecialchars($_POST['adresse']));
        $adrLivr=strip_tags(htmlspecialchars($_POST['adrLivr']));
        
        #on hache le mot de passe
        $password = sha1($password);

        try
        {
            $bdd = new PDO("mysql:host=localhost;dbname=librairie;charset=utf8",'root','');
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            #on verifie si l'email envoyé est déjà utilisé

            $verification=$bdd->prepare("SELECT * FROM clients WHERE Email=?");
            $verification->execute(array($email));
            $userexist=$verification->rowCount();

            if($userexist==0)
            {
                $verification->closeCursor();
                $insertion=$bdd->prepare("INSERT INTO  clients VALUES('',?,?,?,?,?,?,NOW(),0)");
                $insertion->execute(array($nom,$prenom,$email,$password,$tel,$adrLivr));
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
                $_SESSION['Password']=$userinfo['Password'];
                $_SESSION['Adresse']=$userinfo['Adresse'];
                $_SESSION['AdresseLivraison']=$userinfo['AdresseLivraison'];
                $_SESSION['DateCreationCompte']=$userinfo['DateCreationCompte'];
                $requete->closeCursor();
                header('loacation: espaceClient.php');
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
?>