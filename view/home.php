<?php ob_start(); ?>

<main id="home">
	<h1>Liste des livres</h1>
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

<?php $content = ob_get_clean(); ?>


<?php require_once 'view/layout/layout.php'; ?>
