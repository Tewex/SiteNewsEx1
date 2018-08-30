<?php
/*
 * Page de connection
 * Théo Hurlimann
 * 30.08.2018
 * Page permettant de se connecter à l'aide d'un identifiant et un mot de passe.
 */


$erreur = "";
if (filter_has_var(INPUT_POST, 'btnLogin')) {
    $identifiant = filter_input(INPUT_POST, 'tbxIdentifiant');
    $mdp = filter_input(INPUT_POST, 'tbxMdp');
    if ($identifiant == "") {
        $erreur = "Veuillez renseigner votre Identifiant";
    }
    else{
        $result = authenticate($identifiant, $mdp);
        if ($result) {
            header("Location: confirmation.php");
        }
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
        <title> Connection</title>
        <link href="style/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        
        <fieldset>
            <legend>Connection</legend>
            <h2><?php echo $erreur ?></h2>
            <form action="connection.php" method="POST" >
                <label>Identifiant:</label>
                <input type="text" name="tbxIdentifiant" value="<?php echo $identifiant ?>">
                <label>Mot de passe:</label>
                <input type="password" name="tbxMdp" >
                <button type="submit" name="btnLogin">Valider</button>
            </form>
            
        </fieldset>

        <label><a href="./inscription.php" >Pas encore inscrit?</a></label>
    </body>
</html>
