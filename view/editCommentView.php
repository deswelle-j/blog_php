<?php $title = 'Commentaire'; ?>

<?php ob_start(); ?>

<h1>Modfication de commentaire</h1>
<a href="index.php">Retour à la liste de billets</a>

<h3>Commentaires</h3>
<div>
  <form action="index.php?action=editComment&amp;id_comment=<?= $idComment?>" method="post">
  <p>Ajoute un commentaire</p>
  <label for="comment">Commentaire</label>
  <input id="comment" name="comment" type="text" value="<?= $comment['comment'] ?>" >
  <input type="submit" value="Envoyer">
  </form>
</div>  
   
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>