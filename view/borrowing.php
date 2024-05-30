<?php ob_start(); ?>

<main id="borrowing">
	<h1>Emprunts en cours</h1>

	<form action="index.php?action=borrowing" method="post">
		<input type="submit" name="Borrow" value="Nouvel emprunt">
	</form>
	<br>
	<table>
		<thead>
			<tr>
				<th colspan="2">Livre</th>
				<th colspan="2">Emprunteur</th>
				<th rowspan="2">Rendre</th>
			</tr>
			<tr>
				<th>Titre</th>
				<th>Auteur</th>
				<th>Prénom</th>
				<th>Nom</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($borrowings as $borrowing): ?>
				<tr>
					<td><?= $borrowing['title'] ?></td>
					<td><?= $borrowing['author'] ?></td>
					<td><?= $borrowing['first_name'] ?></td>
					<td><?= $borrowing['last_name'] ?></td>
					<td>
						<form action="index.php?action=borrowing" method="post">
							<input type="hidden" name="ClientID" value="<?= $borrowing['ClientID'] ?>">
							<input type="hidden" name="BookID" value="<?= $borrowing['BookID'] ?>">
							<input type="submit" name="Rendre" value="Rendre">
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
	</table>
</main>

<?php $content = ob_get_clean(); ?>

<?php require_once 'view/layout/layout.php'; ?>
