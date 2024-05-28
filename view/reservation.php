<?php ob_start(); ?>

<main id="reservation">
	<form action="index.php?action=reservation" method="post">
		<input type="email" id="email" name="book_name">
        <input type="text" id="firstname" name="book_name">
		<input type="text" id="lastname" name="book_name">
    </form>
</main>

<?php 
$content = ob_get_clean(); 


require_once 'view/layout/layout.php'; ?>
