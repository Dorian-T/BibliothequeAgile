<?php ob_start(); ?>

<main id="home">
    <h1>Oui</h1>
</main>

<?php $content = ob_get_clean(); ?>


<?php require_once 'view/layout/layout.php'; ?>
