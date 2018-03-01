<?php $title = $post['titre']; ?>

<?php ob_start(); ?>

<h1>Ceci est un prototype simpliste de blog</h1>
<a href="index.php">Retour à la liste de billets</a>

<!-- afficher le billet -->
<div class="post">
  <h2><?=$post['titre'] ?> le <?= $post['date_creation'] ?></h2>
  <p><?= $post['contenu'] ?></p>
</div>

<h3>Commentaires</h3>

<?php if(!empty($comments)) : ?>  
  <?php foreach($comments as $comment) : ?> 
    <div class="comment">
      <h4><?= $comment['auteur'] ?> le <?=  $comment['date_commentaire'] ?> </h4>
      <p><?=  $comment['commentaire'] ?></p>
    </div>

  <?php endforeach ?>
<?php else : ?>
  <div>
    <h4>Ce billet ne contient pas de commentaire pourquoi ne pas en mettre un ?</h4>
  </div>
<?php endif ?>

<!-- Formulaire de saisie pour ajouter un commentaire en method post
Redirection ver la page commentaires_post pour traitement de la requette d'insertion -->
<div>
  <form action="index.php?action=addComment&amp;id_billet=<?= $post['id']?>" method="post">
  <p>Ajoute un commentaire</p>
  <label for="auteur">Pseudo</label>
  <input id="auteur" name="author" type="text">
  <label for="commentaire">Commentaire</label>
  <input id="commentaire" name="comment" type="text">
  <input type="submit" value="Envoyer">
  </form>
</div>  
   
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>