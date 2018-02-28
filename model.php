<?php

function getBillets(){
    require_once('database.php');
    //connexion à la base de donnée blog_php
    $db = connexion();
    //preparation d'une requette sql :
    //selectionner les 5 derniers billets
    $req = $db->query('SELECT * FROM billets ORDER BY date_creation DESC LIMIT 0, 5');
    $reponse= $req->fetchAll();
    //fermeture du curseur
    $req->closeCursor();
    return $reponse;
}