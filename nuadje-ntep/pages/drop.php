<?php
    session_start();

    try
    {
        $bdd= new PDO("mysqli:host=localhost;dbname=librairie;charset=utf8",'root','');
        $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $bdd->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

        $requete=$bdd->prepare("DELETE FROM clients WHERE Id=?");
        $requete->execute(array($_SESSION['Id']));
        header('location: ../index.php');
    }
    catch(PDOException $e)
    {
        die("Erreur: ".$e->getMessage());
    }
?>