<?php
/*
 * Page de connection
 * Théo Hurlimann
 * 30.08.2018
 * Page permettant de se connecter à l'aide d'un identifiant et un mot de passe.
 */

require_once './model/fonctions.php';

if (isset($_SESSION['utilisateur'])) {
    header("Location: main.php");
    exit;
}
$erreurIdentifiant = "";
$erreurRemplissage = "Veuiller compléter ce champ.";
$erreurMdp = "";
$prenom = "";
$nom = "";
$identifiant = "";
$erreur = false;
if (filter_has_var(INPUT_POST, 'btnLogin')) {

    $prenom = trim(filter_input(INPUT_POST, 'tbxInscritpionPrenom', FILTER_SANITIZE_STRING));
    $nom = trim(filter_input(INPUT_POST, 'tbxInscritpionNom', FILTER_SANITIZE_STRING));
    $identifiant = filter_input(INPUT_POST, 'tbxInscritpionIdentifiant', FILTER_SANITIZE_STRING);
    $mdp = filter_input(INPUT_POST, 'tbxInscritpionMdp', FILTER_SANITIZE_STRING);
    $mdpValidation = filter_input(INPUT_POST, 'tbxInscritpionMdpValidation', FILTER_SANITIZE_STRING);

    if (empty($prenom))
        $erreur = true;

    if (empty($nom))
        $erreur = true;

    if (empty($identifiant))
        $erreur = true;
    if (empty($mdp))
        $erreur = true;
    if (empty($mdpValidation))
        $erreur = true;
    if ($mdp != $mdpValidation)
        $erreur = true;
    $erreurMdp = "Les 2 mots de passe ne sont pas identiques";
    if (pseudoExists($identifiant)) {
        $erreur = true;
        $erreurIdentifiant = "Cet idientifiant est déjà pris.";
    }
    // si il n'y a pas d'erreur dans les données saisies
    if (empty($erreur)) {
        $idUser = addUser($prenom, $nom, $identifiant, $mdp);


        header("location:connection.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
        <link href="style/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <fieldset>
            <legend>Inscription</legend>

            <form action="./inscription.php" method="POST" >
                <label>Prénom:</label>
                <h3> <?php if ($erreur) echo $erreurRemplissage; ?></h3>
                <input type="text" name="tbxInscritpionPrenom" >

                <label>Nom:</label>
                <h3> <?php echo $erreurRemplissage ?></h3>
                <input type="text" name="tbxInscritpionNom" >

                <label>Identifiant: </label>
                <h3> <?php echo $erreurRemplissage ?></h3>
                <input type="text" name="tbxInscritpionIdentifiant" >

                <label>Mot de passe:<h3></h3></label>
                <h3> <?php if ($erreur) echo $erreurRemplissage; ?></h3>
                <input type="text" name="tbxInscritpionMdp" >

                <label>Validation du mot de passe:</label>
                <h3> <?php if ($erreur) echo $erreurRemplissage; ?></h3>
                <input type="text" name="tbxInscritpionMdpValidation" >
                <h3> <?php echo $erreurMdp ?></h3>

                <button  name="btnLogin">Valider</button>
            </form>

        </fieldset>

        <label><a href="./connection.php" >Retour sur connection</a></label>
    </body>
</html>
