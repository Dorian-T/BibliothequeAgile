<!DOCTYPE html>

<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Bibliothèque Agile</title>

	<link rel="stylesheet" href="css/layout.css">
	<link rel="stylesheet" href="css/home.css">
</head>

<body>
	<header>
		<nav>
			<ul>
				<li><a href="./">Accueil</a></li>
				<li><a href="index.php?action=register">Inscription</a></li>
				<?php if (!isset($_SESSION['admin'])): ?>
					<li><a href="index.php?action=adminlogin">Connexion Admin</a></li>
				<?php else: ?>
					<li><a href="index.php?action=borrowing">Emprunt</a></li>
				<?php endif; ?>
			</ul>
		</nav>
	</header>

	<?= $content; ?>
</body>

</html>
