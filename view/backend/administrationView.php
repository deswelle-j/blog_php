
<?php if ($_SESSION['user_role'] == 'admin') :?>
<?php $title = 'Administration'; ?>

<?php ob_start(); ?>

    <p>modification des billets par l'admin'</p>
    <div class="container">
    <h3>Les billets</h3>
        <?php echo table_html($posts, $updateable = true); ?>
    </div>
    <div class="container">
        <h3>Les commentaires</h3>
        <?php echo table_html($comments, $updateable = true); ?>
    </div>
    <a href="index.php">Accueil</a>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<?php endif ?>
