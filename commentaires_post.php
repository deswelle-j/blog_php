<?php

try{
    $bd = new PDO('mysql:host=localhost;db_name=blog_php;charset=utf8', 'root', '');

}catch (Exception$e){
    die('Erreur :' .$e->getMessage());
}

//Preparation de la requette : INSERT le commentaire le nom de l'auteur et la date actuelle dans la table commentaires

//Execution de la requette

//Fermeture du curseur

//Redirection ferme la page d'acceuil