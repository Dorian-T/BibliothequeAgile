<?php ob_start(); ?>

<main id="register">
    <h1>Page de création de Clients</h1>
	<div>
	<h2>Formulaire d'inscription</h2>
	<form action="index.php?action=register" method="post">
		<div>
			<label for="nom">Nom : </label>
			<input type="text" id="nom" name="nom" required>
		</div>
		<div>
			<label for="prenom">Prénom : </label>
			<input type="text" id="prenom" name="prenom" required>
		</div>
		<div>
			<label for="date_naissance">Date de naissance : </label>
			<input type="date" id="date_naissance" name="date_naissance" required>
		</div>
		<div>
			<label for="telephone">Téléphone : </label>
			<input type="tel" id="telephone" name="telephone" required>
		</div>
		<div>
			<label for="email">Adresse email : </label>
			<input type="email" id="email" name="email" required>
		</div>
		<br>
		<div>
			<label for="valider">Valider</label>
			<input type="submit" id="valider" name="valider">
			<input type="hidden" name="action" value="registerClient">
		</div>
	</form>
</div>
</main>

<?php $content = ob_get_clean(); ?>

<?php require_once 'view/layout/layout.php'; ?>
