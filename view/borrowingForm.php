<?php ob_start(); ?>

<main id="borrowingForm">
	<h1>Nouvel emprunt</h1>
	<form action="index.php?action=borrowing" method="post">
		<label for="ClientID">Emprunteur</label>
		<select name="ClientID" id="ClientID">
			<?php foreach ($clients as $client):
				echo "<option value=\"".$client['id']."\">".$client['first_name']." ".$client['last_name']." "."</option>";
			endforeach; ?>
		</select>
		<br>
		<label for="BookID">Livre</label>
		<select name="BookID" id="BookID">
			<?php foreach ($books as $book):
				echo "<option value=\"".$book['id']."\">".$book['title']." de ".$book['author']." édition ".$book["edition"]. " (". $book["location"].")</option>";
			endforeach; ?>
		</select>
		<br>
		<input type="submit" name="Borrow" value="Valider l'emprunt">
		<input type="submit" name="Cancel" value="Annuler">
	</form>
		
</main>

<?php $content = ob_get_clean(); ?>

<?php require_once 'view/layout/layout.php'; ?>