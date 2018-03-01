      
<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
      
<h1>Ceci est un prototype simpliste de blog</h1>
<!-- display postss, with a link to a comment page -->
  <?php foreach($posts as $data) :?>
    <div class="post">
      <h2><?= $data['titre'] ?></h2>
      <p><?= $data['contenu'] ?></p>
      <a href=index.php?action=post&amp;id_billet=<?= $data['id'] ?>>Commentaires</a>
    </div>
  <?php endforeach ?>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>