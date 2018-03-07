<?php

require('model/model.php');
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');

function listPosts()
{
    $postManager = new PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/listPostsView.php');
}

function post()
{
    $commentManager = new CommentManager();
    $postManager = new PostManager();

    $post = $postManager->getPost($_GET['id_billet']);
    $comments = $commentManager->getComments($_GET['id_billet']);

    require('view/postView.php');
}

function addComment($author, $comment, $idPost)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($author, $comment, $idPost);
    if ($affectedLines === false){
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }else {
        header('Location: index.php?action=post&id_billet=' . $idPost);
    }

}