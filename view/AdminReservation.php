<?php ob_start(); ?>

<main id="adminReservation">
	<h1>Valider les réservations</h1>
	<table>
		<thead>
			<tr>
				<th colspan="2">Livre</th>
				<th colspan="2">Client</th>
				<th rowspan="2">Valider</th>
				<th rowspan="2">Annuler</th>
			</tr>
			<tr>
				<th>Titre</th>
				<th>Auteur</th>
				<th>Prénom</th>
				<th>Nom</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($reservations as $reservation) : ?>
				<tr>
					<td><?= $reservation['title'] ?></td>
					<td><?= $reservation['author'] ?></td>
					<td><?= $reservation['first_name'] ?></td>
					<td><?= $reservation['last_name'] ?></td>
					<td>
						<form action="index.php?action=reservation" method="post">
							<input type="hidden" name="customerId" value="<?= $reservation['customer_id'] ?>">
							<input type="hidden" name="bookId" value="<?= $reservation['book_id'] ?>">
							<input type="submit" name="valider" value="Valider">
						</form>
					</td>
					<td>
						<form action="index.php?action=reservation" method="post">
							<input type="hidden" name="customerId" value="<?= $reservation['customer_id'] ?>">
							<input type="hidden" name="bookId" value="<?= $reservation['book_id'] ?>">
							<input type="submit" name="annuler" value="Annuler">
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
</main>

<?php $content = ob_get_clean(); ?>

<?php require_once 'view/layout/layout.php'; ?>
