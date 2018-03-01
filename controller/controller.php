<?php

require('model/model.php');

function listPosts()
{
    $posts = getPosts();

    require('view/listPostsView.php');
}

function post()
{
    $post = getPost($_GET['id_billet']);
    $comments = getComments($_GET['id_billet']);

    require('view/postView.php');
}

function addComment($author, $comment, $idPost)
{
    $affectedLines = postComment($author, $comment, $idPost);
    if ($affectedLines === false){
        die('Impossible d\'ajouter le commentaire !');
    }else {
        header('Location: index.php?action=post&id_billet=' . $idPost);
    }

}