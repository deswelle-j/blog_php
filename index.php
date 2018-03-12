<?php
session_start();
require('controller/frontend.php');

try{
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id_post']) && $_GET['id_post'] > 0) {
                post();
            }
            else {
                throw new Exception('aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id_post']) && $_GET['id_post'] >0){
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_POST['author'], $_POST['comment'], $_GET['id_post']);
                }else{
                    throw new Exception('tous les champs ne sont pas remplis !');
                }
            }else{
                throw new Exception('aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'editComment'){
            if (isset($_GET['id_comment']) && $_GET['id_comment'] >0){
                if(!empty($_POST['comment'])){
                    updateComment($_POST['comment'], $_GET['id_comment']);
                }else{

                    editComment($_GET['id_comment'], $_GET['id_post']);
                }
            }else{
                throw new Exception('aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'authentification'){
            if (isset($_SESSION['user']) && $_SESSION['user_role']){
                    authentification($_SESSION['user_role']);
            }else{
                userConnection();
            }
        }
    }
    else {
        listPosts();
    }
}
catch(Exception $e){
    $errorMessage = $e->getMessage();
    require('view/errorsView.php');
}
