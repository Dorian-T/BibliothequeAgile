<?php ob_start(); ?>

<main id="home">

	<h1>Liste des livres</h1>

    <form action="index.php?action=home" method="post">
        <label for="categorie-select">Catégorie:</label>
        <select name="categorie-select" id="categorie-select">
			<option value="">Toutes les catégories</option>
			<?php foreach ($categories as $category) : ?>
				<option value="<?= htmlspecialchars($category['id']) ?>" <?= ($category['id'] == $selectedCategory) ? 'selected' : '' ?>>
					<?= htmlspecialchars($category['name']) ?>
				</option>
			<?php endforeach; ?>
		</select>


        <label for="book_name">Nom du livre:</label>
        <input type="text" id="book_name" name="book_name">
        <button type="submit">Rechercher</button>
    </form>
	<br>
	<table>
		<thead>
			<tr>
				<th>Titre</th>
				<th>Auteur</th>
				<th>Edition</th>
				<th>Année de parution</th>
				<?php if (empty($selectedCategory)) : ?>
					<th>Genre</th>
				<?php endif; ?>
				<th>Emplacement</th>
                <th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($books as $book) : ?>
				<tr>
					<td><?= $book['title'] ?></td>
					<td><?= $book['author'] ?></td>
					<td><?= $book['edition'] ?></td>
					<td><?= $book['publication_year'] ?></td>
					<?php if (empty($selectedCategory)) : ?>
						<td><?= $book['genre'] ?></td>
					<?php endif; ?>
					<td><?= $book['location'] ?></td>
                    <td><a href="index.php?action=reservation&id=<?= $book['id'] ?>">réserver</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</main>

<?php
$content = ob_get_clean();


require_once 'view/layout/layout.php'; ?>
