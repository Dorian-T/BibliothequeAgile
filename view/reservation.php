<?php ob_start(); ?>

<main id="reservation">
	<form action="index.php?action=reservation&id=<?= $bookId ?>" method="post">
		<input type="email" name="email" placeholder="email@example.com" required>
        <input type="text" name="firstname" placeholder="Prénom" required>
		<input type="text" name="lastname" placeholder="Nom" required>
		<input type="submit" name="submit" value="Réserver">
    </form>
</main>

<?php
$content = ob_get_clean();


require_once 'view/layout/layout.php'; ?>
