<?php
/*
 * Page de connection
 * Théo Hurlimann
 * 30.08.2018
 * Page permettant de se connecter à l'aide d'un identifiant et un mot de passe.
 */
require_once '/model/fonctions.php';

if (!isset($_SESSION['utilisateur'])) {
    header("Location: connection.php");
    exit;
}

$bienvenu = "Bonjour ".$_SESSION['utilisateur']['prenom']." ".$_SESSION['utilisateur']['nom'].", voici votre fil d'actualités";
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="style/style.css" rel="stylesheet" type="text/css"/>
        <title></title>
    </head>
    <body>
        <h1><?php echo $bienvenu;?></h1>
        <fieldset>
            <legend>Nouveau post</legend>
            <form action="main.php" method="POST">
                <label>Titre</label>
                <input type="text" name="tbxTitre">
                
                <label>Description</label>
                <textarea rows="30" cols="180" type="text" name="textDescription" ></textarea>
                
                <label><button type="submit" name="btnInserer">Inserer</button></label>
            </form>
        </fieldset>
         <label><button type="submit" name="btnDeconnection">Deconnection</button></label>
    </body>
</html>
