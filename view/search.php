<?php ob_start(); ?>

<main id="search">
	<h1>Liste des livres</h1>
	<form action="index.php?action=home" method="post">
        <label for="book_name">Nom du Livre:</label>
        <input type="text" id="book_name" name="book_name" required>
        <button type="submit">Rechercher</button>
    </form>
	<table>
		<thead>
			<tr>
				<th>Titre</th>
				<th>Auteur</th>
				<th>Edition</th>
				<th>Année de paruption</th>
				<th>Genre</th>
				<th>Emplacement</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($books as $book) : ?>
				<tr>
					<td><?= $book['title'] ?></td>
					<td><?= $book['author'] ?></td>
					<td><?= $book['edition'] ?></td>
					<td><?= $book['publication_year'] ?></td>
					<td><?= $book['genre'] ?></td>
					<td><?= $book['location'] ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</main>

<?php 
$content = ob_get_clean(); 


require_once 'view/layout/layout.php'; ?>
