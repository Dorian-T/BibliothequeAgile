<?php ob_start(); ?>

<main id="home">

	<h1>Liste des livres</h1>



    <form action="index.php?action=home" method="post">
        <label for="categorie-select">Catégorie:</label>
        <select name="categorie-select" id="categorie-select">
            <option value="">Toutes les catégories</option>
            <?php foreach ($categories as $category) : ?>
                <option value="<?= htmlspecialchars($category['id']) ?>"><?= htmlspecialchars($category['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="book_name">Nom du Livre:</label>
        <input type="text" id="book_name" name="book_name">
        <button type="submit">Rechercher</button>
    </form>

	<table>
		<thead>
			<tr>
				<th>Titre</th>
				<th>Auteur</th>
				<th>Edition</th>
				<th>Année de parution</th>
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
