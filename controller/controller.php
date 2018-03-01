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