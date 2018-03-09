<?php $title = 'Erreur'; ?>


<?php ob_start(); ?>

<h1>Erreur : <?=$errorMessage ?></h1>

<a href="index.php">Retour à la page d'acceuil</a>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
