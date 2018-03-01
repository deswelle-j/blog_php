<?php
      require('model.php');
      $title = 'Accueil blog';
      $posts = getPosts();
      require('header.php');
      require('indexView.php');
      require('footer.php');
