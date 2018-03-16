
<?php if ($_SESSION['user_role'] == 'admin') :?>
<?php $title = 'Administration'; ?>

<?php ob_start(); ?>

    <div class="container">
    <h3>Les billets</h3>
        <?php echo table_html($posts, $updateable = true); ?>
    </div>
    <div class="container">
        <h3>Les commentaires</h3>
        <?php echo table_html($comments, $updateable = true, 'Comment'); ?>
    </div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<?php endif ?>
