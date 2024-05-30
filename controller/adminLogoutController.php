<?php

/**
 * class AdminLogoutController
 *
 * This class is the controller for the admin logout action.
 * It extends the base Controller class.
 */
class AdminLogoutController extends Controller {

    // === Methods ===

    /**
     * Handles the admin logout.
     */
    public function logout() {
        session_start();
        session_destroy();
        // Redirige vers la page de connexion admin après la déconnexion
        header('Location: /');
        exit();
    }
}
?>
