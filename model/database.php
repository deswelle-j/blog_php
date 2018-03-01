<?php

define('HOST', 'localhost'); 
define('USER', 'root'); 
define('PASS', ''); 
define('DB', 'blog_php'); 

function connection() {
    // options's array for connection
    $db_options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING // On affiche des warnings pour les erreurs, à commenter en prod (valeur par défaut PDO::ERRMODE_SILENT)
    );

    // Connection to the database
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DB, USER, PASS, $db_options);
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }

    return $db;
}