<?php

function getPosts(){
    require_once('database.php');
    $db = connection();
    $req = $db->query('SELECT * FROM billets ORDER BY date_creation DESC LIMIT 0, 5');
    $reponse= $req->fetchAll();
    
    $req->closeCursor();
    return $reponse;
}

function getPost($postId){
    require_once('database.php');
    $db = connection();
    $req = $db->prepare('SELECT titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%imin%ss") AS date_creation 
    FROM billets WHERE id= :id');
    $req->bindValue(':id', $postId, PDO::PARAM_INT);
    $req->execute();
    $reponse=$req->fetch();
    $req->closeCursor();
    return $reponse;
}

function getComments($postId){
    require_once('database.php');
    $db = connection();
     $req= $db->prepare('SELECT auteur, commentaire, id_billet, DATE_FORMAT(date_commentaire, "%d/%m/%Y à %Hh%imin%ss") AS date_commentaire 
     FROM commentaires WHERE id_billet = :id ORDER BY date_commentaire');
     $req->bindValue(':id', $postId, PDO::PARAM_INT);
     $req->execute();
     $reponse=$req->fetchAll();
    $req->closeCursor();
    return $reponse;
}

