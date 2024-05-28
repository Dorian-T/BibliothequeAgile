<?php

/**
 * class RegisterController
 *
 * This class is the controller for the register page.
 * It extends the base Controller class.
 */
class RegisterController extends Controller {

	// === Methods ===

	public function __construct() {
		parent::__construct();
		if (isset($_POST["action"])) {
            if ($_POST["action"] == "registerClient") {
                $this->registerClient();
            }
        }
	}

	/**
	 * Renders the register page.
	 */
	public function render() {

		require_once 'view/register.php';
	}
	private function registerClient() {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $date_naissance = $_POST["date_naissance"];
        $telephone = $_POST["telephone"];
        $email = $_POST["email"];
        $adresse = $_POST["adresse"];

        $this->model->registerClient($nom, $prenom, $date_naissance, $telephone, $email, $adresse);
    }
}
