<?php ob_start(); ?>

<main id="borrowingForm">
	<h1>Nouvel emprunt</h1>
</main>

<?php $content = ob_get_clean(); ?>

<?php require_once 'view/layout/layout.php'; ?>