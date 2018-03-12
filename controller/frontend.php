<?php
use \deswelleJ\Blog\Model\PostManager;
use \deswelleJ\Blog\Model\CommentManager;
use \deswelleJ\Blog\Model\UsersManager;
// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/UsersManager.php');


function listPosts()
{
    $postManager = new PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $commentManager = new CommentManager();
    $postManager = new PostManager();
    $idPost = $_GET['id_post'];
    $post = $postManager->getPost($idPost);
    $comments = $commentManager->getComments($_GET['id_post']);

    require('view/frontend/postView.php');
}

function addComment($author, $comment, $idPost)
{
    $commentManager = new CommentManager();

    $affectedLines = $commentManager->postComment($author, $comment);
    if ($affectedLines === false){
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }else {
        header('Location: index.php?action=post&id_post=' . $idPost);
    }
}
function editComment($idComment, $idPost){
    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($idComment);

    require('view/frontend/editCommentView.php');
}
function updateComment($comment, $idComment){
    $commentManager = new CommentManager();
    $affectedLines = $commentManager->updateCommentDb($_POST['comment'], $idComment);
    if ($affectedLines === false){
        throw new Execption('Impossible de modifier le commentaire !');
    }else {
        header('Location: index.php');
    }
}
function authentification($role){

    if ($role && $role == 'admin'){
        require('view/backend/administrationView.php');
    }else {
        require('Location : index.php');
    }
}
function userConnection($user = false){
    $userManager = new UsersManager();

    $user = $usersManager->userAuthentification();


}