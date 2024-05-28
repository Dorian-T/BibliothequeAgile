<?php ob_start(); ?>

<main id="reservation">
	<h1>Emprunts en cours</h1>
	<table>
		<thead>
			<tr>
				<th colspan="2">Livre</th>
				<th colspan="2">Emprunteur</th>
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
				</tr>
			<?php endforeach; ?>
	</table>
</main>
