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
function supprimeSession() {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}
function authentification($role){

    if ($role && $role == 'admin'){
        $postManager = new PostManager();
        $posts = $postManager->getPosts();
        $commentManager = new CommentManager();
        $comments = $commentManager->comments();
        require('view/backend/administrationView.php');
    }else {
        header('Location: index.php');
    }
}   
function userConnection($email = false, $password = false){
    
    if ($email != false && $password != false){
        $login = trim($email);
        $password =trim($password);
        var_dump($login);
        if (filter_var($login, FILTER_VALIDATE_EMAIL) && !empty($password)) {
            $userManager = new UsersManager();
            $user = $userManager->userAuthentification($login);
            $count = count($user);
            if (count($user) > 0 && password_verify($password, $user[0]['password'])) {
                $_SESSION['user'] = $user[0]['id'];
                $_SESSION['user_fullname'] = $user[0]['firstname'] . ' ' . $user[0]['lastname'];
                $_SESSION['user_role'] = $user[0]['role'];
                authentification($_SESSION['user_role']);
            }else{
                throw new Execption('Utilisateur non trouvé ou mot de passe incorrect');
            }
        }else {
            throw new Execption('Information de connexion incorrectes');
        }
    }else{
        require('view/frontend/connectionView.php');
    }
}
function userLogOut(){
    session_destroy();
    header('Location: index.php');
}

function table_html($array, $updateable = false, $update_url = '') {
    $table = '<table class="table"><tr>';
    if ($updateable)
        $table .= '<th></th>';
    foreach(array_keys($array[0]) as $key) {
        $table .= '<th>' . $key . '</th>';
    }
    $table .= '</tr>';
    foreach($array as $row) {
        $table .= '<tr>';
        
        foreach($row as $value) {
            $table .= '<td>' . $value . '</td>';
        }
        if ($updateable){
            if($update_url == 'Comment'){
            $table .= '<td class="edit"><a href="index.php?action=editComment&amp;id_comment=' .$row['id']. '&amp;id_post='. $row['id_post'] .'"><img class="edit" style="width : 50px" src="public/img/edit.png"/></a></td>';
            $table .= '<td class="delete"><a href="' . $update_url . '?id=' . $row['id'] .'"><img class="edit" style="width : 50px" src="public/img/delete.png"/></a></td>';
            }else {
                $table .= '<td class="edit"><a href="' .  $update_url . '?id=' . $row['id']  .'"><img class="edit" style="width : 50px" src="public/img/edit.png"/></a></td>';
                $table .= '<td class="delete"><a href="' . $update_url . '?id=' . $row['id'] .'"><img class="edit" style="width : 50px" src="public/img/delete.png"/></a></td>';
    
            }
        }
        $table .= '</tr>';
    }
    $table .= '</table>';
    
    return $table;
}