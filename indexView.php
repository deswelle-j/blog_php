      <h1>Ceci est un prototype simpliste de blog</h1>
      <!-- display postss, with a link to a comment page -->
        <?php foreach($posts as $data) :?>
          <div class="post">
            <h2><?= $data['titre'] ?></h2>
            <p><?= $data['contenu'] ?></p>
            <a href=comments.php?id_billet=<?= $data['id'] ?>>Commentaires</a>
          </div>
        <?php endforeach ?>