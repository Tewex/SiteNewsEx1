<?php
// put your code here
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
        <title></title>
        <link href="style/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <fieldset>
            <legend>Inscription</legend>
            <form action="#" method="POST" >
                <label>Prénom:</label>
                <input type="text" name="tbxInscritpionPrenom">
                <label>Nom:</label>
                <input type="text" name="tbxInscritpionNom">
                <label>Identifiant:</label>
                <input type="text" name="tbxInscritpionIdentifiant">
                <label>Mot de passe:</label>
                <input type="text" name="tbxInscritpionMdp"> 
                <label>Validation du mot de passe:</label>
                <input type="text" name="tbxInscritpionMdpValidation"> 
            </form>
            <button  name="btnLogin">Valider</button>
        </fieldset>
        
        <label><a href="./connection.php" >Retour sur connection</a></label>
    </body>
</html>
