<?php
    if(!isset($_POST['envoie']))
    {       # le formulaire n'a pas encore été envoyé
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="img/logo.ico" type="image/x-icon">
        <script type="text/javascript" src="js/index.js"></script>
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/include.css">
        <title>ONLINE BOOKSTORE</title>
    </head>
<body>
    <div id="contain">
        <!--en-tête-->
        <?php
            include_once("include/header.php");
        ?>
        <!--/en-tête-->

        <section>
            <form action="index.php" method="post" onsubmit="return verifForm(this);">
                <fieldset>
                    <h1>Bienvenue sur ONLINE BOOKSTORE</h1>
                    <label for="login">Login</label><input type="email" name="login" placeholder="votre email" id="login" required oninput="verifLogin(this);" title="votre email">
                    <span id="errlog"></span>
                    <label for="password">Password</label><input type="password" name="password" placeholder="8 caractères minimum" id="password" required oninput="verifMdp(this);" maxlength="16" title="8 caractères minimum">
                    <span id="errmdp"><?php if(isset($_GET['errpass'])){echo $_GET['errpass'];} ?></span>
                    <input type="submit" value="Validez" title="se connecter" name="envoie"> <input type="reset" value="Effacer" title="vider les champs"><br>
                    <div id="lien">
                        <a href="pages/nouveauClient.php" id="newclient" title="s'inscrire"><p>Vous êtes un nouveau client: cliquez ICI</p></a>
                        <a href="#forgot-pw" id="forgotpassword" title="Si vous avez oubliez votre mot de passe cliquez ici">mot de passe oublié?</a>
                    </div>
                </fieldset>
            </form>
        </section>

        <!--footer-->
        <?php
            include_once("include/footer.php");
        ?>
        <!--/footer-->

    </div>
</body>
</html>

<?php
    }
    else    #après l'envoie du formaulaire
    {       #on verifie les données envoyé par l'utilisateur avec des regex(expression regulières)
        if(!empty($_POST['login']) and !empty($_POST['password']))
        {
            $login=strip_tags(htmlspecialchars($_POST['login']));
            $password=strip_tags(htmlspecialchars($_POST['password']));

            if(!preg_match('#[a-zA-Z0-9]+@[a-zA-Z0-9_-]+\.[a-z]{2,4}#',$login))
            {
                header('location: pages/error.php');
            }
            if(!preg_match('#[a-zA-Z0-9.-_*@&$]{8,16}#',$password))
            {
                header('location: pages/error.php');
            }

            $password=sha1($password);      #on hache le mot de passe

            try
            {# connection à la base de donnée
                $connexion=new PDO("mysql:host=localhost;dbname=librairie;charset=utf8",'root','');
                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            }
            catch(PDOException $e)
            {
                die('Erreur:'.$e->getMessage());
            }

            #on verifie s'il est bien dans la base de donnée
            $requete=$connexion->prepare('SELECT * FROM clients WHERE Email=? and Password=?');
            $requete->execute(array($login,$password));
            $userexist=$requete->rowCount();

            if($userexist==1)        #s'il existe on ouvre sa session
            {
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
                $_SESSION['NombreAchat']=$userinfo['NombreAchat'];

                $requete->closeCursor();
                header('location: pages/espaceCLients.php');
            }
            else        #s'il n'existe pas on affiche la page error.php
            {
                $requete->closeCursor();
                header('location: pages/error.php');
            }
        }
        else        #si les données envoyés envoyé par l'utilisateur sont vides
        {
            header('location: index.php?errpass=remplissez tous les champs');
        }
    }
?>