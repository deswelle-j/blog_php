      <?php
      //connexion à la base de donnée blog_php
      require('model.php');
      $post = getPost($_GET['id_billet']);
      $title = $post['titre'];
      $comments = getComments($_GET['id_billet']);
      require('header.php');
      require('commentsView.php');
      requite('footer.php');
