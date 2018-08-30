<?php
$prenom = "";
$nom = "";
$identifiant = "";
$errors = false;
if (filter_has_var(INPUT_POST, 'btnLogin')) {
   
    $prenom = trim(filter_input(INPUT_POST, 'tbxInscritpionPrenom', FILTER_SANITIZE_STRING));
    $nom = trim(filter_input(INPUT_POST, 'tbxInscritpionNom', FILTER_SANITIZE_STRING));
    $identifiant = filter_input(INPUT_POST, 'tbxInscritpionIdentifiant');
    $mdp = filter_input(INPUT_POST, 'tbxInscritpionMdp');
    $mdpValidation = filter_input(INPUT_POST, 'tbxInscritpionMdpValidation');
   
    if (empty($lastName))
        $errors = true;
    if (empty($firstName))
        $errors = true;
    if (empty($pseudo))
        $errors = true;
    if (pseudoExists($pseudo))
        $errors = true;
    if (empty($pwd))
        $errors = true;
    if ($pwd != $pwd2)
        $errors = true;

    // si il n'y a pas d'erreur dans les données saisies
    if (empty($errors)) {
        $idUser = addUser($lastName, $firstName, $pseudo, $pwd);
        

        header("location:showusers.php");
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
                <input type="text" name="tbxInscritpionPrenom" required="">
                <label>Nom:</label>
                <input type="text" name="tbxInscritpionNom" required="">
                <label>Identifiant:</label>
                <input type="text" name="tbxInscritpionIdentifiant" required="">
                <label>Mot de passe:</label>
                <input type="text" name="tbxInscritpionMdp" required=""> 
                <label>Validation du mot de passe:</label>
                <input type="text" name="tbxInscritpionMdpValidation" required=""> 
                <button  name="btnLogin">Valider</button>
            </form>
            
        </fieldset>
        
        <label><a href="./connection.php" >Retour sur connection</a></label>
    </body>
</html>
