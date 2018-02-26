<?php

try{
    $db = new PDO('mysql:host=localhost;dbname=blog_php;charset=utf8', 'root', '');

}catch (Exception$e){
    die('Erreur :' .$e->getMessage());
}
//Recuperation et verification des valeurs du formulaire
var_dump($_POST);
if(isset($_POST['auteur']) && isset($_POST['commentaire']) && isset($_POST['id_billet']) && ($_POST['auteur'] && $_POST['commentaire'] && $_POST['id_billet']) != '' ){
    //Preparation de la requette : INSERT le commentaire le nom de l'auteur et la date actuelle dans la table commentaires
    $author = htmlspecialchars($_POST['auteur']);
    $comment = htmlspecialchars($_POST['commentaire']);
    $id_billet = htmlspecialchars($_POST['id_billet']);
    echo 'test reussit';

    $req = $db->prepare('INSERT INTO commentaires(auteur, commentaire, id_billet, date_commentaire) VALUES(:author, :comment, :id_billet, NOW())');
    $req->bindValue(':author', $author, PDO::PARAM_STR);
    $req->bindValue(':comment', $comment, PDO::PARAM_STR);
    $req->bindValue(':id_billet', $id_billet, PDO::PARAM_INT);
    //Execution de la requette
    $req->execute();
    // $req->execute(array($author, $comment));

    //Fermeture du curseur
    $req->closeCursor();
    //Redirection ferme la page d'acceuil
    header('Location: index.php');
    die();
}else{
    //Si l'auteur ou le commentaire ne sont pas renseignés rediriger vers index.php
    //Option : Ajouter un message d'erreur
    header('Location: index.php');
    die();
}

