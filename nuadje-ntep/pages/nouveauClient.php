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
                            <td class="label"><label for="nom">Nom</label></td> <td><input type="text" required id="nom" name="nom" placeholder="enter your name" oninput="verifNom(this);" autocomplete="off"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="prenom">Prénom</label></td> <td><input type="text" required id="prenom" name="prenom" placeholder="enter your surname" autocomplete="off" oninput="verifPrenom(this);"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="email">Email</label></td> <td><input type="email" required id="email" name="email" placeholder="enter your email" autocomplete="off" oninput="verifEmail(this);"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="password">Password</label></td> <td><input type="password" required id="password" name="password" placeholder="enter your password" autocomplete="off" oninput="verifPassword(this);"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="cpassword">Confirmer password</label></td> <td><input type="password" required id="cpassword" name="cpassword" placeholder="re-enter your password" autocomplete="off" oninput="verifConfPassword(this);"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="adresse">Adresse</label></td> <td><input type="tel" required id="adresse" name="adresse" placeholder="enter your phone number" autocomplete="off" oninput="verifAdresse(this);"></td>
                        </tr>
                        <tr>
                            <td class="label"><label for="adrLivr">Adresse de livraison</label></td> <td><input type="text" required id="adrLivr" name="adrLivr" placeholder="enter your location" autocomplete="off" oninput="verifAdreLivr(this);"></td>
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