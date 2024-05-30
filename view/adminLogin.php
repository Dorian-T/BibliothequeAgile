<?php ob_start(); ?>

<main id="admin-login">

    <h1>Connexion Administrateur</h1>
    
    <?php
    if (isset($_GET['error']) && $_GET['error'] == 1) {
        echo '<p style="color: red;">Email ou mot de passe incorrect</p>';
    }
    ?>
    
    <form action="index.php?action=adminlogin" method="POST">
        <input type="hidden" name="action" value="loginAdmin">
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Se connecter</button>
    </form>
    
</main>

<?php
$content = ob_get_clean();

require_once 'view/layout/layout.php';
?>
