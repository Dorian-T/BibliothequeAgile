<?php ob_start(); ?>

<main id="adminReservation">
	<h1>Valider les réservations</h1>
	<table>
		<thead>
			<th>
				<th colspan="2">Livre</th>
				<th colspan="2">Client</th>
				<th rowspan="2">Valider</th>
				<th rowspan="2">Annuler</th>
			</th>
			<th>
				<th>Titre</th>
				<th>Auteur</th>
				<th>Prénom</th>
				<th>Nom</th>
			</th>
		</thead>
		<tbody>
			<?php foreach ($reservations as $reservation) : ?>
				<tr>
					<td><?= $reservation['title'] ?></td>
					<td><?= $reservation['author'] ?></td>
					<td><?= $reservation['first_name'] ?></td>
					<td><?= $reservation['last_name'] ?></td>
					<td>
						<form action="index.php?action=adminReservation" method="post">
							<input type="hidden" name="customerId" value="<?= $reservation['customer_id'] ?>">
							<input type="hidden" name="bookId" value="<?= $reservation['book_id'] ?>">
							<input type="submit" value="Valider">
						</form>
					</td>
					<td>
						<form action="index.php?action=cancelReservation" method="post">
							<input type="hidden" name="customerId" value="<?= $reservation['customer_id'] ?>">
							<input type="hidden" name="bookId" value="<?= $reservation['book_id'] ?>">
							<input type="submit" value="Annuler">
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
</main>
