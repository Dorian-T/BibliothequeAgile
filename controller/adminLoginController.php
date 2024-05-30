<?php

/**
 * class AdminLoginController
 *
 * This class is the controller for the admin login page.
 * It extends the base Controller class.
 */
class AdminLoginController extends Controller {

    // === Methods ===

    public function __construct() {
        parent::__construct();
        if (isset($_POST["action"]) && $_POST["action"] == "loginAdmin") {
            $this->loginAdmin();
        }
    }

    /**
     * Renders the admin login page.
     */
    public function render() {
        require_once 'view/adminLogin.php';
    }

    /**
     * Handles the admin login.
     */
    private function loginAdmin() {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $admin = $this->model->connexionAdmin($email, $password);

        if ($admin) {
            // Start a session and store the admin information
            session_start();
            $_SESSION['admin'] = $admin;
            // Redirect to the admin dashboard
            header('Location: ./');
            exit();
        } else {
            // Redirect to the login page with an error message
            header('Location: index.php?action=adminlogin&error=1');
            exit();
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        // Redirige vers la page de connexion admin après la déconnexion
        header('Location:./');
        exit();
    }
}
?>
