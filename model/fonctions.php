<?php

/*
 * fichier: login.php
 * auteur : Hurlimann Théo
 * description : permet de se connecter
 * Version : 1.0
 */

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
    $sql = "SELECT idUser, prenom,nom, identifiant, motDePasse FROM users "
            ." WHERE identifiant = :identifiant AND motDePasse = :motDePasse";

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

function addUser($prenom, $nom, $identifiant, $mdp) {
    $db = connectionBdd();
    $sql = "INSERT INTO users(prenom,nom,identifiant,motDePasse) " .
            " VALUES (:prenom, :nom, :identifiant, :motDePasse)";
    $request = $db->prepare($sql);
    if ($request->execute(array(
                'prenom' => $prenom,
                'nom' => $nom,
                'identifiant' => $identifiant,
                'motDePasse' => sha1($mdp)))) {
        return $db->lastInsertID();
    } else {
        return NULL;
    }
}

function pseudoExists($identifiant) {
    $db = connectionBdd();
    $sql = "SELECT idUser FROM users "
            . "WHERE identifiant = :identifiant";

    $request = $db->prepare($sql);
    if ($request->execute(array(
                'identifiant' => $identifiant))) {
        $result = $request->fetch(PDO::FETCH_ASSOC);
        if (isset($result['idUser'])) {
            return $result['idUser'];
        } else {
            return NULL;
        }
    } else {
        return NULL;
    }
}