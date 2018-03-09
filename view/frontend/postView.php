<?php $title = $post['title']; ?>

<?php ob_start(); ?>

<h1>Ceci est un prototype simpliste de blog</h1>
<a href="index.php">Retour à la liste de billets</a>

<!-- display a post -->
<div class="post">
  <h2><?=$post['title'] ?> le <?= $post['date_creation'] ?></h2>
  <p><?= $post['content'] ?></p>
</div>

<h3>Commentaires</h3>

<?php if(!empty($comments)) : ?>  
  <?php foreach($comments as $comment) : ?> 
    <div class="comment">
      <h4><?= $comment['author'] ?></h4>
      <p>
        le <?=  $comment['dateComment'] ?>
        (<a href="index.php?action=editComment&amp;id_comment=<?=$comment['id']?>&amp;id_post=<?= $idPost ?>">modifier</a>)
      </p>
      <p><?=  $comment['comment'] ?></p>
    </div>

  <?php endforeach ?>
<?php else : ?>
  <div>
    <h4>Ce billet ne contient pas de commentaire pourquoi ne pas en mettre un ?</h4>
  </div>
<?php endif ?>

<div>
  <form action="index.php?action=addComment&amp;id_post=<?= $post['id']?>" method="post">
  <p>Ajoute un commentaire</p>
  <label for="auteur">Pseudo</label>
  <input id="auteur" name="author" type="text">
  <label for="comment">Commentaire</label>
  <input id="comment" name="comment" type="text">
  <input type="submit" value="Envoyer">
  </form>
</div>  
   
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>