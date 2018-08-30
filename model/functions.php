<?php

/*
 * fichier: login.php
 * auteur : Hurlimann Théo
 * description : permet de se connecter
 * Version : 1.0
 */
define('HOST', 'localhost');
define('DBNAME', 'faurum');
define('DBUSER', 'root'); //Utilisateur
define('DBPWD', ''); //Mot de passe



/**
 * Crée un connecteur persistant à la base et/ou le retourne.
 * @staticvar $dbc // Connecteur static à la base
 * @return \PDO // Le PDO
 */
function connectionBdd() {
    static $dbc = null;

    if ($dbc == null) {
        try {
            $dbc = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBUSER, DBPWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_PERSISTENT => true));
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage() . '<br />';
            echo 'N° : ' . $e->getCode();
            die('Could not connect to MySQL');
        }
    }
    return $dbc;
}



function authenticate($identifiant, $motddepasse) {

    // Si $email existe et que le mot de passe (sha1) est le bon, retourner true

    $db = connectionBdd();
    $sql = "SELECT idUser, prenom,nom, identifiant FROM users "
            . "WHERE email = :email AND password = :password";

    $request = $db->prepare($sql);
    if ($request->execute(array(
                'identifiant' => $identifiant,
                'motDePasse' => sha1($motddepasse)))) {
        $result = $request->fetch(PDO::FETCH_ASSOC);
        $_SESSION['utilisateur'] = $result;
        if ($result == "") {
            return FALSE;
        } else {
            return true;
        }
    } else {
        return false;
    }

   
}