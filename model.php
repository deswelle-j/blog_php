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

function getPost($postId){
    require_once('database.php');
    $db = connection();
    //preparation d'une requette sql : selectionner le billet passer en $_GET
    $req = $db->prepare('SELECT titre, contenu, DATE_FORMAT(date_creation, "%d/%m/%Y à %Hh%imin%ss") AS date_creation 
    FROM billets WHERE id= :id');
    //execution de la requette avec le parametre $_GET['id']
    $req->bindValue(':id', $postId, PDO::PARAM_INT);
    $req->execute();
    $reponse=$req->fetch();
    $req->closeCursor();
    return $reponse;
}

function getComments($postId){
    require_once('database.php');
    $db = connection();

     //Preparation d'une nouvelle requette sql: Selectionner les commentaires du billet
     $req= $db->prepare('SELECT auteur, commentaire, id_billet, DATE_FORMAT(date_commentaire, "%d/%m/%Y à %Hh%imin%ss") AS date_commentaire 
     FROM commentaires WHERE id_billet = :id ORDER BY date_commentaire');
     $req->bindValue(':id', $postId, PDO::PARAM_INT);
     $req->execute();
     $reponse=$req->fetchAll();
    $req->closeCursor();
    return $reponse;
}