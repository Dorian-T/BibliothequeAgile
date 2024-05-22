<!DOCTYPE html>

<html lang="fr">

<head>
	<meta charset="utf-8">
	<title>Bibliothèque Agile</title>

	<link rel="stylesheet" href="css/layout.css">
	<link rel="stylesheet" href="css/home.css">
	<!-- TODO: Add the CSS files here -->
</head>

<body>
	<header>
		<nav>
			<ul>
				<li><a href="./">Accueil</a></li>
				<li><a href="index.php?action=register">Inscription</a></li>
				<!-- <li><a href="index.php?action=...">...</a></li> -->
			</ul>
		</nav>
	</header>

	<?= $content; ?>
</body>

</html>
