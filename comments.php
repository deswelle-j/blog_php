      <?php
      //connexion à la base de donnée blog_php
      require('model.php');
      $post = getPost($_GET['id_billet']);
      $comments = getComments($_GET['id_billet']);  
      require('commentsView.php');
      
