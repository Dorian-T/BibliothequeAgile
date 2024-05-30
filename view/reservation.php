<?php ob_start(); ?>

<main id="reservation">
    <h1>Réservation de livre</h1>
    <form action="index.php?action=reservation&id=<?= $bookId ?>" method="post">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" placeholder="email@example.com" required>

        <label for="firstname">Prénom :</label>
        <input type="text" id="firstname" name="firstname" placeholder="Prénom" required>

        <label for="lastname">Nom :</label>
        <input type="text" id="lastname" name="lastname" placeholder="Nom" required>

        <label for="birthdate">Date de naissance :</label>
        <input type="date" id="birthdate" name="birthdate" required>

        <label for="phone">Numéro de téléphone :</label>
        <input type="tel" id="phone" name="phone" placeholder="Numéro de téléphone" required>

        <input type="submit" name="submit" value="Réserver">
    </form>
</main>

<?php
$content = ob_get_clean();

require_once 'view/layout/layout.php';
?>
