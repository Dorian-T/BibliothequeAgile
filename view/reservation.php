<?php ob_start(); ?>

<main id="reservation">
	<form action="index.php?action=reservation" method="post">
		<input type="email" name="email" placeholder="Email@example.com">
        <input type="text" name="firstname" placeholder="Prénom">
		<input type="text" name="lastname" placeholder="Nom">
		<input type="number" name="bookid" value=$id ><!-- hidden -->
    </form>
</main>

<?php 
$content = ob_get_clean(); 


require_once 'view/layout/layout.php'; ?>
