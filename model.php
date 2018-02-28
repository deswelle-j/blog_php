<?php

function getPosts(){
    require_once('database.php');
    //connection to the blog_php database
    $db = connection();

    $req = $db->query('SELECT * FROM billets ORDER BY date_creation DESC LIMIT 0, 5');
    $reponse= $req->fetchAll();
    
    $req->closeCursor();
    return $reponse;
}